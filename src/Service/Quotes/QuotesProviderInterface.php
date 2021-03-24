<?php

namespace App\Service\Quotes;

interface QuotesProviderInterface
{
    /**
     * @param string $author
     *
     * @return array
     */
    public function getAuthorQuotes(string $author): array;
}
