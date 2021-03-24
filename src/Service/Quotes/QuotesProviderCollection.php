<?php

namespace App\Service\Quotes;

/**
 * This class is pseudo API.
 * As said in task: "no need to perform real calls to our source API"
 */
class QuotesProviderCollection
{
    private iterable $providers;

    /**
     * @param iterable $providers
     */
    public function __construct(iterable $providers)
    {
        $this->providers = $providers;
    }

    /**
     * @param string $author
     *
     * @return array
     */
    public function getAuthorQuotes(string $author): array
    {
        $quotes = [];

        /** @var QuotesProviderInterface $provider */
        foreach ($this->providers as $provider) {
            $quotes[] = $provider->getAuthorQuotes($author);
        }

        return array_unique(array_merge(...$quotes));
    }
}
