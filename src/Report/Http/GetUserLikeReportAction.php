<?php

namespace App\Report\Http;


use App\Core\Http\BaseAction;
use App\Report\UserLikeReportLoader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/users")
 */
class GetUserLikeReportAction extends BaseAction
{

    /**
     * @var UserLikeReportLoader
     */
    private $query;

    public function __construct(UserLikeReportLoader $query)
    {
        $this->query = $query;
    }

    /**
     * @Route("/like/report")
     */
    public function __invoke()
    {
//        $data = $this->query->load();
//        return $this->query();
        // TODO: Implement __invoke() method.
    }
}