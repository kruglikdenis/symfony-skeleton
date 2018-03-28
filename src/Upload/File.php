<?php

namespace App\Upload;


use BornFree\TacticianDomainEvent\Recorder\ContainsRecordedEvents;
use BornFree\TacticianDomainEvent\Recorder\EventRecorderCapabilities;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity()
 * @ORM\Table(name="files")
 */
class File implements ContainsRecordedEvents
{
    use EventRecorderCapabilities;

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var FileInfo
     * @ORM\Embedded(class="App\Upload\FileInfo", columnPrefix=false)
     */
    private $info;

    public function __construct(UploadedFile $file)
    {
        $this->id = Uuid::uuid4();
        $this->attachFile($file);
    }

    /**
     * Attach file to entity
     *
     * @param UploadedFile $file
     * @throws FileNotValidException
     */
    private function attachFile(UploadedFile $file)
    {
        if (!$file->isValid()) {
            throw new FileNotValidException();
        }

        $this->info = new FileInfo($file);
        $this->record(new FileWasAttached($file, $this->name()));
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return (string) $this->id . $this->info->normalizedExtension();
    }
}