<?php

namespace App\Post\Http;


use App\Core\Http\Annotation\ResponseTransformer;
use App\Core\Http\FilterCollection;
use App\Post\Entity\Posts;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/post")
 */
class SearchPostAction extends Controller
{
    /**
     * @Method("GET")
     * @ResponseTransformer(PostTransformer::class)
     *
     * @param Posts $posts
     * @param FilterCollection $filters
     */
    public function __invoke(Posts $posts, FilterCollection $filters)
    {
    }
}