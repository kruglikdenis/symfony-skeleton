<?php

namespace App\Security\Entity;


interface Credentials
{
    public function retrieveByEmail(Email $email): Credential;
}