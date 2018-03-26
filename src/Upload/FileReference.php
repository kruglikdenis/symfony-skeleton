<?php

namespace App\Upload;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class FileReference
{
    private $path;

    private function __construct(string $path)
    {
        $this->path = $path;
    }

    public static function url(string $url): self
    {
        return new self($url);
    }
}