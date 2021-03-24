<?php

namespace spec\App\Service\Quotes\Provider;

use App\Service\Quotes\Provider\QuoteAwesomeProvider;
use PhpSpec\ObjectBehavior;

class QuoteAwesomeProviderSpec extends ObjectBehavior
{
    public function it_should_return_author_quotes()
    {
        $this->beConstructedWith('/var/www/html');
        $this->getAuthorQuotes('steve-jobs')->shouldEqual([
            'Your time is limited, so don’t waste it living someone else’s life!',
            'The only way to do great work is to love what you do.',
        ]);
        $this->getAuthorQuotes('plato')->shouldEqual([
            'We can easily forgive a child who is afraid of the dark; the real tragedy of life is when men are afraid of the light.',
        ]);
        $this->getAuthorQuotes('non-existing')->shouldEqual([]);
    }
}
