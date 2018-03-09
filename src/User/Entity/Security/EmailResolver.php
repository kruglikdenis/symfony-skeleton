<?php

namespace App\User\Entity\Security;


interface EmailResolver
{
    public function retrieveByEmail(Email $email): Credentials;
}