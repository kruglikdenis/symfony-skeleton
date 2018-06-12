<?php

namespace App\Post\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 * @ORM\Table(name="likes")
 */
class Like
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Post\Entity\Post", inversedBy="likes")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     *
     * @var Post
     */
    private $post;

    /**
     * @ORM\Embedded(class="App\Post\Entity\User")
     *
     * @var User
     */
    private $liker;

    public function __construct(Post $post, User $liker)
    {
        $this->id = Uuid::uuid4();
        $this->post = $post;
        $this->liker = $liker;
    }
}