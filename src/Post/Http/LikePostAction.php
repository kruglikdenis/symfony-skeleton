<?php

namespace App\Post\Http;


use App\Core\Doctrine\Flush;
use App\Post\Entity\Post;
use App\Post\Entity\Posts;
use App\Post\Entity\User;
use App\Security\Entity\Credential;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/posts")
 */
class LikePostAction
{
    /**
     * @var Posts
     */
    private $posts;

    public function __construct(Posts $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @Route("/{id}/like")
     * @Method({"POST"})
     * @ParamConverter(
     *     "post",
     *     class="App\Post\Entity\Post",
     *     options={
     *         "repository_method" = "retrieveById"
     *     }
     * )
     *
     * @param Post $post
     * @param Credential $credential
     */
    public function __invoke(Post $post, Credential $credential, Flush $flush)
    {
        $liker = new User($credential->id());
        $post->like($liker);

        $flush();
    }
}