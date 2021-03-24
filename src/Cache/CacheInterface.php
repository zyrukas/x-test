<?php

namespace App\Cache;

interface CacheInterface
{
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key);

    /**
     * @param string   $key
     * @param          $value
     * @param int|null $ttl
     *
     * @return mixed
     */
    public function set(string $key, $value, ?int $ttl = null);

    /**
     * @param string   $key
     * @param          $value
     * @param int|null $ttl
     *
     * @return mixed
     */
    public function setViaMessage(string $key, $value, ?int $ttl = null);
}
