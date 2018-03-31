<?php


namespace App\Core\Doctrine\Cursor;


abstract class AbstractCursor implements Cursor
{
    /**
     * Cursor limit
     *
     * @var int|null
     */
    protected $limit;

    /**
     * Cursor offset
     *
     * @var int
     */
    protected $offset = 0;

    /**
     * Cached count value
     *
     * @var int|null
     */
    private $count;

    /**
     * {@inheritdoc}
     */
    public function setLimit(?int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * {@inheritdoc}
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return iterator_to_array($this, false);
    }

    /**
     * Get cursor items list with applied limit and offset as traversable object
     *
     * @return \Traversable
     */
    public function getIterator(): \Traversable
    {
        if (0 === $this->limit) {
            return new \ArrayIterator();
        }

        return $this->doIterate();
    }

    /**
     * Get total items in cursor, is not affected by limit and offset
     *
     * @return int
     */
    public function count(): int
    {
        if (null === $this->count) {
            $this->count = $this->doCount();
        }

        return $this->count;
    }

    /**
     * Creates iterator with items
     *
     * @return \Traversable
     */
    abstract protected function doIterate(): \Traversable;

    /**
     * Calculates count value
     *
     * @return int
     */
    abstract protected function doCount(): int;
}