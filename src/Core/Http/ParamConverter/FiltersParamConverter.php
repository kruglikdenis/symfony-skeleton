<?php

namespace App\Core\Http\ParamConverter;


use App\Core\Http\Filter;
use App\Core\Http\FilterCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class FiltersParamConverter implements ParamConverterInterface
{

    public function apply(Request $request, ParamConverter $configuration)
    {
        $filters = new FilterCollection();
        foreach ($request->get('filter', []) as $field => $value) {
            $filters->add(new Filter($field, $value));
        }

        $request->attributes->set($configuration->getName(), $filters);
    }

    public function supports(ParamConverter $configuration): bool
    {
        return FilterCollection::class === $configuration->getClass();
    }
}