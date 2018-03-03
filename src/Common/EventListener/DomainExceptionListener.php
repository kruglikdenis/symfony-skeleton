<?php

namespace App\Common\EventListener;

use App\Common\DomainException;
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

        $event->setResponse(new JsonResponse($e->getMessage(), $e->getCode()));
    }
}
