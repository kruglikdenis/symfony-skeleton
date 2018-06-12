<?php

namespace App\Core\Http;


use League\Fractal\TransformerAbstract;

abstract class Transformer extends TransformerAbstract
{
    abstract public function transform($payload): array;

    /**
     * Get property from object
     *
     * @param string $field
     * @param $object
     *
     * @return mixed
     */
    protected function get(string $field, $object)
    {
        $reflectionObject = new \ReflectionObject($object);
        $property = $reflectionObject->getProperty($field);
        $property->setAccessible(true);

        return $property->getValue($object);
    }
}