<?php

namespace App\Post\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 * @ORM\Table(name="posts")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var Author
     * @ORM\Embedded(class="Example\Posts\Model\Author")
     */
    private $author;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var
     * @ORM\Column(type="string")
     */
    private $media;

    /**
     * @var ArrayCollection|Tag[]
     * @ORM\ManyToMany(targetEntity="Tag", cascade={"persist"})
     */
    private $tags;

    public function __construct(PostBuilder $builder)
    {
        $this->id = Uuid::uuid4();
        $this->description = $builder->description();
        $this->tags = new ArrayCollection($builder->tags());
        $this->media = $builder->media();
        $this->author = $builder->author();
    }

    public static function builder(): PostBuilder
    {
        return new PostBuilder();
    }
}