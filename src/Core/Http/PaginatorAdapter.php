<?php

namespace App\Core\Http;


use Doctrine\ORM\Tools\Pagination\Paginator;
use League\Fractal\Pagination\PaginatorInterface;

class PaginatorAdapter implements PaginatorInterface
{
    /**
     * @var Paginator
     */
    private $paginator;

    /**
     * @var Pagination
     */
    private $pagination;

    public function __construct(Paginator $paginator, Pagination $pagination)
    {
        $this->paginator = $paginator;
        $this->pagination = $pagination;
    }

    public function getCurrentPage()
    {
        return $this->pagination->offset();
    }

    public function getLastPage()
    {
        return 0;
    }

    public function getTotal()
    {
        return $this->paginator->count();
    }

    public function getCount()
    {
        return $this->paginator->count();
    }

    public function getPerPage()
    {
        return $this->pagination->limit();
    }

    public function getCursorTime()
    {
        return $this->pagination->before();
    }

    public function getUrl($page)
    {
        return '/';
    }
}
