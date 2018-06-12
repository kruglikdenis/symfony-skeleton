<?php

namespace App\Core\Http;


use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Serializer\DataArraySerializer as FractalDataArraySerializer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DataArraySerializer extends FractalDataArraySerializer
{
    /**
     * @var NormalizerInterface
     */
    private $serializer;

    public function __construct(NormalizerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param string $resourceKey
     * @param array $data
     * @return array|bool|float|int|string
     */
    public function collection($resourceKey, array $data)
    {
        return $this->serializer->normalize(
            parent::collection($resourceKey, $data)
        );
    }

    /**
     * @param string $resourceKey
     * @param array $data
     * @return array|bool|float|int|string
     */
    public function item($resourceKey, array $data)
    {
        return $this->serializer->normalize($data);
    }

    /**
     * @param PaginatorInterface $paginator
     * @return array
     */
    public function paginator(PaginatorInterface $paginator)
    {
        if (!$paginator instanceof PaginatorAdapter) {
            return [];
        }
        
        return [
            'pagination' => [
                'total' => $paginator->getTotal(),
                'offset' => $paginator->getCurrentPage(),
                'limit' => $paginator->getPerPage(),
                'before' => $paginator->getCursorTime()
            ]
        ];
    }
}