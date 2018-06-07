<?php

namespace App\Upload\Service;


use App\Upload\Entity\FileUrlGenerator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LocalFileUrlGenerator implements FileUrlGenerator
{
    /**
     * @inheritdoc
     */
    public function generate(UploadedFile $file, ?string $name = null): string
    {
        return sprintf('%s.%s', $name, $this->getExtension($file));
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    private function getExtension(UploadedFile $file): string
    {
        if ($file instanceof UploadedFile) {
            $ext = $file->getClientOriginalExtension();
            if ($ext) {
                return $ext;
            }

            return $file->guessClientExtension();
        }

        $ext = $file->getExtension();

        if ($ext) {
            return $ext;
        }

        return $file->guessExtension();
    }
}