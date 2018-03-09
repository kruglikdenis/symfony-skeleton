<?php

namespace App\User\Entity\Security;


interface Identifiable
{
    public function uuid(): string;

    public function identify(): string;
}