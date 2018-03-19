<?php

namespace App\Core\EventListener;

use App\Core\Exception\DomainException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class DomainExceptionListener
{
    public function onDomainException(GetResponseForExceptionEvent $event)
    {
        $e = $event->getException();

        if (!($e instanceof DomainException)) {
            return;
        }

        $response = new JsonResponse($e->getResponseBody(), $e->getCode());

        $event->setResponse($response);
    }
}
