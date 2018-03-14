<?php

namespace App\Common\Normalizer;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UuidNormalizer implements NormalizerInterface
{

    public function normalize($object, $format = null, array $context = array())
    {
        return (string) $object;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Uuid;
    }
}