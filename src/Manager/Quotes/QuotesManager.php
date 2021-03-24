<?php

namespace App\Manager\Quotes;

use App\Cache\CacheInterface;
use App\Service\Quotes\QuotesProviderCollection;

class QuotesManager
{
    private QuotesProviderCollection $quotesProvider;
    private CacheInterface $cache;

    /**
     * @param QuotesProviderCollection $quotesProvider
     * @param CacheInterface           $cache
     */
    public function __construct(QuotesProviderCollection $quotesProvider, CacheInterface $cache)
    {
        $this->quotesProvider = $quotesProvider;
        $this->cache = $cache;
    }

    /**
     * @param string $author
     *
     * @return array
     */
    public function getAuthorQuotes(string $author): array
    {
        $cacheKey = 'getAuthorQuotes_' . $author;
        $authorQuotes = $this->cache->get($cacheKey);
        if (!$authorQuotes) {
            $authorQuotes = $this->quotesProvider->getAuthorQuotes($author);
            $this->cache->setViaMessage($cacheKey, json_encode($authorQuotes));

            return $authorQuotes;
        }

        return json_decode($authorQuotes, true);
    }
}
