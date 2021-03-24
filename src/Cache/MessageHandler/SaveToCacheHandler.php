<?php

namespace App\Cache\MessageHandler;

use App\Cache\CacheInterface;
use App\Cache\Message\SaveToCache;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SaveToCacheHandler implements MessageHandlerInterface
{
    private CacheInterface $cache;

    /**
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param SaveToCache $message
     *
     * @return void
     */
    public function __invoke(SaveToCache $message): void
    {
        $this->cache->set($message->getKey(), $message->getContent());
    }
}
