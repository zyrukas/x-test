<?php

namespace spec\App\Service\Quotes\Provider;

use App\Service\Quotes\Provider\TheySaidSoProvider;
use PhpSpec\ObjectBehavior;

class TheySaidSoProviderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(TheySaidSoProvider::class);
    }

    public function it_should_return_author_quotes()
    {
        $this->getAuthorQuotes('aristotle')->shouldEqual([
            'It is the mark of an educated mind to be able to entertain a thought without accepting it.',
            'Happiness is the meaning and the purpose of life, the whole aim and end of human existence.',
        ]);
        $this->getAuthorQuotes('non-existing')->shouldEqual([]);
    }
}
