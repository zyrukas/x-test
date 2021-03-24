<?php

namespace App\Transformer\Quotes;

use function Symfony\Component\String\u;

class ShoutTransformer
{
    /**
     * @param array $quotes
     *
     * @return array
     */
    public static function transformQuotes(array $quotes): array
    {
        return array_map(function ($quote) {
            if (empty($quote)) {
                return '';
            }

            return u($quote)->upper()->trimEnd('.')->trimEnd('!')->append('!')->toString();
        }, $quotes);
    }
}
