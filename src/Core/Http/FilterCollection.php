<?php

namespace App\Core\Http;


class FilterCollection implements \Iterator
{
    /**
     * @var array
     */
    private $filters;

    /**
     * @var int
     */
    private $position;

    /**
     * FilterCollection constructor.
     *
     * @param Filter[]|null $filters
     */
    public function __construct(?array $filters = [])
    {
        $this->filters = $filters;

        $this->rewind();
    }

    /**
     * @param Filter $filter
     */
    public function add(Filter $filter)
    {
        $this->filters[] = $filter;
    }

    public function current(): Filter
    {
        return $this->filters[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->filters[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }
}