<?php

namespace App\Core\Http;


use Doctrine\ORM\Tools\Pagination\Paginator;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Symfony\Component\HttpFoundation\RequestStack;
use League\Fractal\Manager;

class Presenter
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var Manager
     */
    private $fractalManager;

    public function __construct(RequestStack $requestStack, DataArraySerializer $dataSerializer)
    {
        $this->requestStack = $requestStack;

        $this->fractalManager = (new Manager())
            ->setSerializer($dataSerializer);
    }

    /**
     * @param mixed $data
     * @param Transformer $transformer
     *
     * @return array
     */
    public function resource($data, Transformer $transformer)
    {
        if (\is_array($data) || $data instanceof Paginator) {
            return $this->collection($data, $transformer);
        }

        return $this->item($data, $transformer);
    }

    /**
     * @param mixed $item
     * @param Transformer $transformer
     *
     * @return array
     */
    public function item($item, Transformer $transformer): array
    {
        return $this->fractalManager->createData(new Item($item, $transformer))
            ->toArray();
    }

    /**
     * Present collection of items
     *
     * @param \Traversable $data
     * @param Transformer $transformer
     *
     * @return array
     */
    public function collection(\Traversable $data, Transformer $transformer): array
    {
        $resource = new Collection($data, $transformer);

        if ($data instanceof Paginator) {
            $resource->setPaginator(
                new PaginatorAdapter($data, $this->paginationSettings())
            );
        }

        return $this->fractalManager->createData($resource)->toArray();
    }

    /**
     * @return Pagination
     */
    private function paginationSettings(): Pagination
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            return Pagination::buildDefault();
        }

        foreach ($request->attributes->all() as $value) {
            if ($value instanceof Pagination) {
                return $value;
            }
        }

        return Pagination::buildDefault();
    }
}