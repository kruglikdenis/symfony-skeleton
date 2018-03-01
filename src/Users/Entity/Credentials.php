<?php

namespace App\Users\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Credentials
{
    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $identity;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $secret;

    public function __construct($identity, $secret)
    {
        $this->identity = $identity;
        $this->secret = $secret;
    }
}