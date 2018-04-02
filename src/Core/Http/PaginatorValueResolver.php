<?php

namespace App\Core\Http;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class PaginatorValueResolver implements ArgumentValueResolverInterface
{

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return Paginator::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $paginator = new Paginator();

        $paginator->limit = (int) $request->query->get('limit');
        $paginator->offset = (int) $request->query->get('offset');

        yield $paginator;
    }
}