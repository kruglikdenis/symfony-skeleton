<?php

namespace App\Core\Http;


class Pagination
{
    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $before;

    public function __construct(int $offset = 0, int $limit = 20, ?int $before = null)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->before = (int) $before;
    }

    /**
     * @return Pagination
     */
    public static function buildDefault(): self
    {
        return new self();
    }

    /**
     * @return int
     */
    public function offset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function limit(): int
    {
        return $this->limit;
    }

    public function before(): int
    {
        return $this->before;
    }
}