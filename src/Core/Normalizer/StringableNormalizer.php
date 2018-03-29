<?php

namespace App\Core\Normalizer;


use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class StringableNormalizer implements NormalizerInterface
{

    public function normalize($object, $format = null, array $context = array())
    {
        return (string) $object;
    }

    public function supportsNormalization($data, $format = null)
    {
        if (is_object($data) && method_exists($data, '__toString')) {
            return true;
        }

        if (is_null($data)) {
            return true;
        }

        return is_scalar($data);
    }
}