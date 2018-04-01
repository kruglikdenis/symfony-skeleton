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
    private $loader;

    public function __construct(UserLikeReportLoader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @Route("/like/report")
     */
    public function __invoke()
    {
        return $this->loader->load();
    }
}