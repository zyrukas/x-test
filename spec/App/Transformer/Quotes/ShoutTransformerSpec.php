<?php

namespace spec\App\Transformer\Quotes;

use App\Transformer\Quotes\ShoutTransformer;
use PhpSpec\ObjectBehavior;

class ShoutTransformerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ShoutTransformer::class);
    }

    public function it_should_transform_string_to_uppercase_and_add_exclamation_mark()
    {
        $this::transformQuotes([
            'lorem ipsum quote!',
            'lorem ipsum quote.',
            'lorem ipsum quote',
            '',
        ])->shouldBeEqualTo([
            'LOREM IPSUM QUOTE!',
            'LOREM IPSUM QUOTE!',
            'LOREM IPSUM QUOTE!',
            '',
        ]);
    }
}
