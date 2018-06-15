<?php

namespace App\Post\Http;


use App\Core\Http\Annotation\ResponseTransformer;
use App\Core\Http\FilterCollection;
use App\Core\Http\Pagination;
use App\Post\Entity\Criteria\SearchCriteria;
use App\Post\Entity\PostRepository;
use App\Post\Http\Transformer\PostTransformer;
use Doctrine\ORM\Tools\Pagination\Paginator;
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
     * @param PostRepository $posts
     * @param FilterCollection $filters
     * @param Pagination $pagination
     *
     * @return Paginator
     */
    public function __invoke(PostRepository $posts, FilterCollection $filters, Pagination $pagination): Paginator
    {
        return $posts->searchWithPagination(
            new SearchCriteria($filters),
            $pagination
        );
    }
}