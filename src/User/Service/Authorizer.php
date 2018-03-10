<?php

namespace App\User\Service;


use App\User\Entity\Security\Credentials;

interface Authorizer
{
    public function authorize(Credentials $credentials);
}