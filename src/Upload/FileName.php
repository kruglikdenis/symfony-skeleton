<?php

namespace App\Upload;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class FileName
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $fullName;

    public function __construct(string $extension = '')
    {
        $extension = $extension ? '.' . $extension : '';

        $this->fullName = sha1(uniqid(mt_rand(), true))
            . $extension;
    }

    public function __toString(): string
    {
        return $this->fullName;
    }
}