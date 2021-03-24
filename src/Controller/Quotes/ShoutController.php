<?php

namespace App\Controller\Quotes;

use App\Exception\JsonResponseException;
use App\Manager\Quotes\QuotesManager;
use App\Transformer\Quotes\ShoutTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShoutController extends AbstractController
{
    private const MAX_LIMIT = 10;

    /**
     * @param string        $author
     * @param Request       $request
     * @param QuotesManager $quotesManager
     *
     * @return JsonResponse
     */
    public function shout(string $author, Request $request, QuotesManager $quotesManager): JsonResponse
    {
        self::validateLimit($limit = (int) $request->get('limit', self::MAX_LIMIT));

        $quotes = $quotesManager->getAuthorQuotes($author);
        if (empty($quotes)) {
            return $this->json(['message' => 'Not found.'], Response::HTTP_NOT_FOUND);
        }
        $quotes = ShoutTransformer::transformQuotes(array_slice($quotes, 0, $limit));

        return $this->json($quotes);
    }

    /**
     * @param int $limit
     *
     * @return void
     */
    private static function validateLimit(int $limit): void
    {
        if ($limit > self::MAX_LIMIT) {
            throw new JsonResponseException(Response::HTTP_BAD_REQUEST, 'Invalid limit. Max ' . self::MAX_LIMIT . '.');
        }
    }
}
