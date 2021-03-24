<?php

namespace App\Cache\Message;

class SaveToCache
{
    private string $key;
    private string $content;

    /**
     * @param string $key
     * @param string $content
     */
    public function __construct(string $key, string $content)
    {
        $this->key = $key;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
