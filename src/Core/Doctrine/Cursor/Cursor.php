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
     */
    public function setLimit(?int $limit): void;

    /**
     * Set cursor offset
     * Says to return items starting from offset position, counting from 0
     *
     * @param int $offset
     */
    public function setOffset(int $offset): void;

    /**
     * Get cursor items list as array with applied limit and offset
     *
     * @return array
     */
    public function toArray(): array;
}