<?php

namespace App\Upload;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class FileReference
{
    const STORAGE_URL = 'url';

    private $storage;

    private $path;

    private function __construct(string $storage, string $path)
    {
        $this->storage = $storage;
        $this->path = $path;
    }

    public static function url(string $url): self
    {
        return new self(self::STORAGE_URL, $url);
    }
}