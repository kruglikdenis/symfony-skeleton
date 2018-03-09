<?php

namespace App\User\Entity;


class UserBuilder
{
    public function build(): User
    {
        return new User($this);
    }
}