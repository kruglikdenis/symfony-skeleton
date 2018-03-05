<?php

namespace App\User\Entity\Security;


interface Identifiable
{
    public function identity(): string;
}