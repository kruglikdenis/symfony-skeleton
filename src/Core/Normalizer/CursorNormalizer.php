<?php

namespace App\Core\Normalizer;


use App\Core\Doctrine\Cursor\Cursor;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CursorNormalizer implements NormalizerInterface
{

    /**
     * @param Cursor $object
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return [
            'data' => $object->toArray(),
            'paggination' => [
                'total_count' => $object->count(),
                'limit' => $object->limit(),
                'offset' => $object->offset()
            ]
        ];
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Cursor;
    }
}