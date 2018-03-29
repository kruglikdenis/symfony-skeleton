<?php

namespace App\Upload;


use BornFree\TacticianDomainEvent\Recorder\ContainsRecordedEvents;
use BornFree\TacticianDomainEvent\Recorder\EventRecorderCapabilities;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Upload\FileRepository")
 * @ORM\Table(name="files")
 */
class File implements ContainsRecordedEvents
{
    use EventRecorderCapabilities;

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @Groups({"api_file"})
     */
    private $id;

    /**
     * @var FileInfo
     *
     * @ORM\Embedded(class="App\Upload\FileInfo", columnPrefix=false)
     * @Groups({"api_file"})
     */
    private $info;

    public function __construct(FileInfo $info)
    {
        $this->id = Uuid::uuid4();
        $this->info = $info;
    }

    /**
     * Get file name
     *
     * @return FileName
     */
    public function name(): FileName
    {
        return $this->info->name();
    }
}