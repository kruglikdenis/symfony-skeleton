<?php

namespace App\Upload;


use League\Flysystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

class File implements Writable
{
    public const UPLOAD_PATH = '';

    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * @var string|null
     */
    private $path;

    public function __construct(UploadedFile $file)
    {
        if (!$file->isValid()) {
            throw new FileNotValidException();
        }

        if (!static::support($file)) {
            throw new FileNotSupportedException();
        }

        $this->file = $file;
    }

    /**
     * Save file
     *
     * @param Filesystem $filesystem
     * @return FileReference
     */
    public function write(Filesystem $filesystem): FileReference
    {
        if (null == $this->path) {
            $stream = fopen($this->file->getRealPath(), 'r+');
            $this->path = $this->path();
            $filesystem->writeStream($this->path, $stream);
            fclose($stream);
        }

        return FileReference::url($this->path);
    }

    /**
     * Get file path
     *
     * @return string
     */
    private function path(): string
    {
        if (null !== $this->path) {
            return $this->path;
        }

        $ext = $this->extension();
        $filename = sha1(uniqid(mt_rand(), true));

        return $filename . ($ext ? '.' . $ext : '') ;
    }


    /**
     * Get extension
     *
     * @return null|string
     */
    private function extension(): ?string
    {
        $ext = $this->file->guessClientExtension();

        if (null !== $ext) {
            $ext = $this->file->getClientOriginalExtension();
        }

        if (null !== $ext) {
            $originalName = $this->file->getClientOriginalName();
            $ext = preg_replace('/.*\.?([^\.]*)$/is','$1', $originalName);
            if($ext == $originalName) {
                $ext = null;
            }
        }

        return $ext;
    }

    /**
     * Get uploaded file
     *
     * @return UploadedFile
     */
    public function uploadedFile(): UploadedFile
    {
        return $this->file;
    }

    /**
     * Get rule for validation
     *
     * @return Constraint
     */
    public static function validationRule(): Constraint
    {
        return new Assert\File([
            'maxSize' => '50M',
            'maxSizeMessage' => "The maximum allowed file size is 50MB.",
        ]);
    }

    public static function support(UploadedFile $file): bool
    {
        return true;
    }
}