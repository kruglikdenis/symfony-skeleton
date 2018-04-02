<?php

namespace App\Report\Http;


use App\Core\Doctrine\Cursor\Cursor;
use App\Core\Http\BaseAction;
use App\Core\Http\Paginator;
use App\Report\MostActiveUsersReport;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/users")
 */
class GetUserLikeReportAction extends BaseAction
{
    /**
     * @var MostActiveUsersReport
     */
    private $loader;

    public function __construct(MostActiveUsersReport $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @Route("/like/report")
     *
     * @param Paginator $paginator
     * @return Cursor
     */
    public function __invoke(Paginator $paginator): Cursor
    {
        return $this->loader->load($paginator);
    }
}