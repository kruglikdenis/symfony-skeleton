<?php

namespace App\User\Entity\Security;


interface Credentials
{
    public function retrieveByEmail(Email $email): Credential;
}