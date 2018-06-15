<?php

namespace App\Core\Entity;


interface SoftDelete
{
    /**
     * Delete self
     */
    public function delete(): void;

    /**
     * Is deleted?
     */
    public function isDeleted(): bool;
}