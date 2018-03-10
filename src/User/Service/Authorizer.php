<?php

namespace App\User\Service;


use App\User\Entity\Security\Credential;

interface Authorizer
{
    public function authorize(Credential $credentials);
}