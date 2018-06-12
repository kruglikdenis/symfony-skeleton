<?php

namespace App\Core\Http\ParamConverter;


use App\Core\Http\Pagination;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class PaginationParamConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration)
    {
        $page = $request->get('page', []);

        $request->attributes->set(
            $configuration->getName(),
            new Pagination(
                $page['offset'] ?? 0,
                $page['limit'] ?? 20,
                $page['before'] ?? time()
            )
        );
    }

    public function supports(ParamConverter $configuration)
    {
        return Pagination::class === $configuration->getClass();
    }
}