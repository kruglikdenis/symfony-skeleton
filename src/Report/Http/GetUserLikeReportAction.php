<?php

namespace App\Report\Http;


use App\Core\Http\BaseAction;
use App\Report\UserLikeReportQuery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/users")
 */
class GetUserLikeReportAction extends BaseAction
{

    /**
     * @var UserLikeReportQuery
     */
    private $query;

    public function __construct(UserLikeReportQuery $query)
    {
        $this->query = $query;
    }

    /**
     * @Route("/like/report")
     */
    public function __invoke()
    {
        $data = $this->query->load();
//        return $this->query();
        // TODO: Implement __invoke() method.
    }
}