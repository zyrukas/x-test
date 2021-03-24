<?php

namespace spec\App\Manager\Quotes;

use App\Cache\CacheInterface;
use App\Service\Quotes\QuotesProviderCollection;
use PhpSpec\ObjectBehavior;

class QuotesManagerSpec extends ObjectBehavior
{
    public function it_should_get_author_quotes_and_trigger_cache(
        QuotesProviderCollection $quotesProvider,
        CacheInterface $cache
    ) {
        $author = 'steve-jobs';
        $cacheKey = 'getAuthorQuotes_' . $author;
        $quotes = ['Sometimes life is going to hit you in the head with a brick. Don\'t lose faith.'];
        $cache->get($cacheKey)->shouldBeCalledOnce()->willReturn(json_encode($quotes));

        $this->beConstructedWith($quotesProvider, $cache);

        $this->getAuthorQuotes($author)->shouldEqual($quotes);
    }

    public function it_should_get_author_quotes_and_trigger_messages_and_cache(
        QuotesProviderCollection $quotesProvider,
        CacheInterface $cache
    ) {
        $author = 'steve-jobs';
        $cacheKey = 'getAuthorQuotes_' . $author;
        $quotes = ['Sometimes life is going to hit you in the head with a brick. Don\'t lose faith.'];

        $cache->get($cacheKey)->shouldBeCalledOnce()->willReturn(false);
        $quotesProvider->getAuthorQuotes($author)->shouldBeCalledOnce()->willReturn($quotes);
        $cache->setViaMessage($cacheKey, json_encode($quotes))->shouldBeCalledOnce();

        $this->beConstructedWith($quotesProvider, $cache);

        $this->getAuthorQuotes($author)->shouldEqual($quotes);
    }
}
