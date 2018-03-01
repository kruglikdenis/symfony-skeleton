<?php

namespace App\Users\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity
 * @ORM\Table(name="credentials")
 */
class Credentials
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

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

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $salt;

    public function __construct($identity, $secret)
    {
        $this->id = Uuid::uuid4();
        $this->identity = $identity;
        $this->secret = $secret;
        $this->salt = md5(uniqid(null, true));
    }

    public function identity(): string
    {
        return $this->identity;
    }

    public function secret(): string
    {
        return $this->secret;
    }

    public function salt(): string
    {
        return $this->salt;
    }
}