<?php

namespace App\Cache;

use App\Cache\Message\SaveToCache;
use Redis;
use Symfony\Component\Messenger\MessageBusInterface;

class RedisCache implements CacheInterface
{
    private const WAITING = 'WAITING';

    private ?Redis $redis = null;
    private string $host;
    private string $port;

    private MessageBusInterface $bus;

    /**
     * @param string              $host
     * @param string              $port
     * @param MessageBusInterface $bus
     */
    public function __construct(string $host, string $port, MessageBusInterface $bus)
    {
        $this->host = $host;
        $this->port = $port;
        $this->bus = $bus;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        try {
            $this->connect();
        } catch (\RedisException $exception) {
            return null;
        }

        $cache = $this->redis->get($key);
        if ($cache === self::WAITING) {
            return null;
        }

        return $cache;
    }

    /**
     * @param string   $key
     * @param mixed    $value
     * @param int|null $ttl
     *
     * @return void
     */
    public function setViaMessage(string $key, $value, ?int $ttl = null)
    {
        try {
            $this->connect();
        } catch (\RedisException $exception) {
            return;
        }

        $this->bus->dispatch(new SaveToCache($key, $value));

        if ($ttl === null) {
            $this->redis->set($key, self::WAITING);
        } else {
            $this->redis->setex($key, $ttl, self::WAITING);
        }
    }

    /**
     * @param string   $key
     * @param mixed    $value
     * @param int|null $ttl
     *
     * @return void
     */
    public function set(string $key, $value, ?int $ttl = null)
    {
        try {
            $this->connect();
        } catch (\RedisException $exception) {
            return;
        }

        if ($ttl === null) {
            $this->redis->set($key, $value);
        } else {
            $this->redis->setex($key, $ttl, $value);
        }
    }

    /**
     * Connect only if not connected.
     *
     * @throws \RedisException
     */
    private function connect()
    {
        if (!$this->redis || $this->redis->ping() != '+PONG') {
            $this->redis = new Redis();
            $this->redis->connect($this->host, $this->port);
        }
    }
}
