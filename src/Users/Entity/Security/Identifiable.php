<?php

namespace App\Users\Entity\Security;


interface Identifiable
{
    public function identity(): string;
}