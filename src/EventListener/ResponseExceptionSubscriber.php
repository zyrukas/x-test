<?php

namespace App\EventListener;

use App\Exception\JsonResponseException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ResponseExceptionSubscriber implements EventSubscriberInterface
{
    /**
     * @param ExceptionEvent $event
     *
     * @return void
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        if ($_ENV['APP_ENV'] === 'dev') {
            return;
        }

        $throwable = $event->getThrowable();

        if ($throwable instanceof JsonResponseException) {
            $responseArray = ['message' => $throwable->getMessages() ?? $throwable->getMessage()];
        } else {
            $responseArray = ['message' => 'Bad request.'];
        }

        //@TODO implement logging logic. f.e sentry.

        $response = new JsonResponse($responseArray, $throwable->getStatusCode());
        $response->headers->set('Content-Type', 'application/problem+json');
        $event->setResponse($response);
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::EXCEPTION => 'onKernelException'];
    }
}
