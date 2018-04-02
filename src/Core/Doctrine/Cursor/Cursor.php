<?php

namespace App\Core\Doctrine\Cursor;


interface Cursor extends \Countable, \IteratorAggregate
{
    /**
     * Set cursor limit
     * Says how many items (not more then) should be returned by getItems method
     * If limit was not set then all items of cursor should be returned
     *
     * @param int|null $limit
     * @return Cursor
     */
    public function setLimit(?int $limit): self ;

    /**
     * Set cursor offset
     * Says to return items starting from offset position, counting from 0
     *
     * @param int $offset
     * @return Cursor
     */
    public function setOffset(int $offset): self;

    /**
     * Get limit
     *
     * @return int|null
     */
    public function limit(): ?int;

    /**
     * Get offset
     *
     * @return int|null
     */
    public function offset(): ?int;

    /**
     * Get cursor items list as array with applied limit and offset
     *
     * @return array
     */
    public function toArray(): array;
}