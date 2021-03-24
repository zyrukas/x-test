<?php

namespace spec\App\Service\Quotes;

use App\Service\Quotes\Provider\QuoteAwesomeProvider;
use App\Service\Quotes\Provider\TheySaidSoProvider;
use PhpSpec\ObjectBehavior;

class QuotesProviderCollectionSpec extends ObjectBehavior
{
    public function it_should_return_author_quotes_of_providers(
        QuoteAwesomeProvider $quoteAwesomeProvider,
        TheySaidSoProvider $theySaidSoProvider
    ) {
        $author = 'steve-jobs';
        $quoteAwesomeProvider->getAuthorQuotes($author)->shouldBeCalled()->willReturn(['Sometimes life is going to hit you in the head with a brick. Don\'t lose faith.']);
        $theySaidSoProvider->getAuthorQuotes($author)->shouldBeCalled()->willReturn([
            'Sometimes when you innovate, you make mistakes. It is best to admit them quickly, and get on with improving your other innovations.',
            'Simple can be harder than complex: You have to work hard to get your thinking clean to make it simple. But it’s worth it in the end because once you get there, you can move mountains.',
            'Your time is limited, so don’t waste it living someone else’s life.',
        ]);

        $this->beConstructedWith([$quoteAwesomeProvider, $theySaidSoProvider]);
        $this->getAuthorQuotes($author)->shouldEqual([
            'Sometimes life is going to hit you in the head with a brick. Don\'t lose faith.',
            'Sometimes when you innovate, you make mistakes. It is best to admit them quickly, and get on with improving your other innovations.',
            'Simple can be harder than complex: You have to work hard to get your thinking clean to make it simple. But it’s worth it in the end because once you get there, you can move mountains.',
            'Your time is limited, so don’t waste it living someone else’s life.',
        ]);
    }
}
