<?php

namespace App\Post\Entity;

use App\Core\Entity\UUIDTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Post\Entity\PostRepository")
 * @ORM\Table(name="posts")
 */
class Post
{
    use UUIDTrait;

    /**
     * @var User
     * @ORM\Embedded(class="App\Post\Entity\User")
     *
     * @Groups({"api_post"})
     */
    private $author;

    /**
     * @var string
     * @ORM\Column(type="string")
     *
     * @Groups({"api_post"})
     */
    private $description;

    /**
     * @var Media
     * @ORM\Embedded(class="App\Post\Entity\Media")
     *
     * @Groups({"api_post"})
     */
    private $media;

    /**
     * @var ArrayCollection|Tag[]
     * @ORM\ManyToMany(targetEntity="App\Post\Entity\Tag", cascade={"persist"})
     *
     * @Groups({"api_post"})
     */
    private $tags;

    /**
     * @var ArrayCollection|Like[]
     * @ORM\OneToMany(targetEntity="App\Post\Entity\Like", cascade={"persist"}, mappedBy="post")
     */
    private $likes;

    public function __construct(PostBuilder $builder)
    {
        $this->id = $this->generateUuid();

        $this->description = $builder->description();
        $this->media = $builder->media();
        $this->author = $builder->author();
        $this->tags = new ArrayCollection($builder->tags());
        $this->likes = new ArrayCollection();
    }

    public static function builder(): PostBuilder
    {
        return new PostBuilder();
    }

    /**
     * Add like to post
     *
     * @param User $liker
     */
    public function addLike(User $liker)
    {
        $likes = $this->likes->matching(
            Criteria::create()->where(Criteria::expr()->eq('liker', $liker))
        );

        if (0 === $likes->count()) {
            $this->likes->add(new Like($this, $liker));
        }
    }

    /**
     * @return int
     */
    public function countLikes(): int
    {
        return $this->likes->count();
    }
}