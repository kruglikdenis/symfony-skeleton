<?php

namespace App\User\Service;


use Symfony\Component\Security\Core\User\UserInterface;

interface Authorizer
{
    public function authorize(UserInterface $credentials);
}