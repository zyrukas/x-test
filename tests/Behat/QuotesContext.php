<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use App\Controller\Quotes\ShoutController;
use App\Exception\JsonResponseException;
use App\Manager\Quotes\QuotesManager;
use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
final class QuotesContext implements Context
{
    private QuotesManager $quotesManager;
    private ShoutController $shoutController;

    private ?array $quotesContent = null;
    private ?JsonResponseException $exception = null;

    /**
     * @param QuotesManager     $quotesManager
     * @param ShoutController   $shoutController
     */
    public function __construct(
        QuotesManager $quotesManager,
        ShoutController $shoutController
    ) {
        $this->quotesManager = $quotesManager;
        $this->shoutController = $shoutController;
    }

    /**
     * @Then the author list response should be received
     */
    public function theAuthorListResponseShouldBeReceived(): void
    {
        if (empty($this->authorsContent)) {
            throw new \RuntimeException('Empty list received');
        }
    }

    /**
     * @When asked for author quotes
     *
     * @return void
     */
    public function askedForAuthorQuotes(): void
    {
        $response = $this->shoutController->shout('steve-jobs', new Request(), $this->quotesManager);
        $this->quotesContent = json_decode($response->getContent(), true);
    }

    /**
     * @When asked for :limit author quotes
     *
     * @param int $limit
     *
     * @return void
     */
    public function askedForAuthorQuotesWithLimit(int $limit): void
    {
        $this->exception = null;
        try {
            $this->shoutController->shout('test', new Request(['limit' => $limit]), $this->quotesManager);
        } catch (JsonResponseException $exception) {
            $this->exception = $exception;
        }
    }

    /**
     * @Then I get exception
     */
    public function iGetException(): void
    {
        if ($this->exception === null) {
            throw new \RuntimeException('Exception has not been thrown');
        }
    }

    /**
     * @Then I do not get exception
     */
    public function iDoNotGetException(): void
    {
        if ($this->exception !== null) {
            throw new \RuntimeException('Exception has been thrown');
        }
    }

    /**
     * @Then the quotes list should be received
     */
    public function theQuotesListShouldBeReceived(): void
    {
        if (empty($this->quotes)) {
            throw new \RuntimeException('Empty list received');
        }
    }

    /**
     * @Then the quotes list response should be received
     */
    public function theQuotesListResponseShouldBeReceived(): void
    {
        if (empty($this->quotesContent)) {
            throw new \RuntimeException('Empty list received');
        }
    }
}
