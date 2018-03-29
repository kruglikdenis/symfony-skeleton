<?php

namespace App\Post\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table(name="posts")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     *
     * @Groups({"api_post_create"})
     */
    private $id;

    /**
     * @var Author
     * @ORM\Embedded(class="App\Post\Entity\Author")
     *
     * @Groups({"api_post_create"})
     */
    private $author;

    /**
     * @var string
     * @ORM\Column(type="string")
     *
     * @Groups({"api_post_create"})
     */
    private $description;

    /**
     * @var
     * @ORM\Embedded(class="App\Post\Entity\Media")
     *
     * @Groups({"api_post_create"})
     */
    private $media;

    /**
     * @var ArrayCollection|Tag[]
     * @ORM\ManyToMany(targetEntity="Tag", cascade={"persist"})
     *
     * @Groups({"api_post_create"})
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