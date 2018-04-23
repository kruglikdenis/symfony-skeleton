<?php

namespace App\Report\Http;


use App\Core\Doctrine\Cursor\Cursor;
use App\Core\Http\Paginator;
use App\Report\MostActiveUsersReport;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/users")
 */
class GetUserLikeReportAction
{
    /**
     * @var MostActiveUsersReport
     */
    private $report;

    public function __construct(MostActiveUsersReport $report)
    {
        $this->report = $report;
    }

    /**
     * @Route("/like/report")
     *
     * @param Paginator $paginator
     * @return Cursor
     */
    public function __invoke(Paginator $paginator): Cursor
    {
        return $this->report->load($paginator);
    }
}