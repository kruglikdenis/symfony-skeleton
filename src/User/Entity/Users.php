<?php

namespace App\User\Entity;


interface Users
{
    /**
     * Add user
     *
     * @param User $user
     */
    public function add(User $user): void;
}