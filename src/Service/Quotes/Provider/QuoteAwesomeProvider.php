<?php

namespace App\Service\Quotes\Provider;

use App\Service\Quotes\QuotesProviderInterface;
use function Symfony\Component\String\u;

/**
 * This class is pseudo.
 * As said in task: "no need to perform real calls to our source API"
 */
class QuoteAwesomeProvider implements QuotesProviderInterface
{
    private string $projectDir;
    private ?array $quotes = null;

    /**
     * @param string $projectDir
     */
    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

    /**
     * @param string $author
     *
     * @return array
     */
    public function getAuthorQuotes(string $author): array
    {
        return $this->findAuthorQuotes(self::denormalizeAuthor($author));
    }

    /**
     * @param string $author
     *
     * @return array
     */
    private function findAuthorQuotes(string $author): array
    {
        $authorQuotes = array_map(function ($quote) use ($author) {
            if ($author === $quote['author']) {
                return $quote['quote'];
            }

            return null;
        }, $this->getAllQuotes());

        return array_values(array_filter($authorQuotes));
    }


    /**
     * @return array
     */
    private function getAllQuotes(): array
    {
        if ($this->quotes === null) {
            $quotesFilePath = $this->projectDir . '/data/quotes.json';
            $content = file_get_contents($quotesFilePath);
            $this->quotes = json_decode($content, true)['quotes'];
        }

        return $this->quotes;
    }

    /**
     * @param string $author
     *
     * @return string
     */
    private static function denormalizeAuthor(string $author): string
    {
        return u($author)->replace('-', ' ')->title(true);
    }
}
