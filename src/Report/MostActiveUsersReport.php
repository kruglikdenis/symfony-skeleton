<?php

namespace App\Report;


use App\Core\Doctrine\Cursor\Cursor;
use App\Core\Doctrine\Cursor\NativeQueryCursor;
use App\Core\Http\Paginator;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MostActiveUsersReport extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var ResultSetMapping
     */
    protected $rsm;

    /**
     * @var ResultSetMapping
     */
    protected $countRsm;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        $this->rsm = $this->configureMapping();
        $this->countRsm = (new ResultSetMapping())
            ->addScalarResult('count', 'count');
    }

    /**
     * Load report
     *
     * @param Paginator $paginator
     * @return Cursor
     */
    public function load(Paginator $paginator): Cursor
    {
        return (new NativeQueryCursor($this->itemsQuery(), $this->countQuery()))
            ->setLimit($paginator->limit)
            ->setOffset($paginator->offset);
    }

    /**
     * Generate query for items
     *
     * @return NativeQuery
     */
    private function itemsQuery(): NativeQuery
    {
        return $this->em->createNativeQuery('
            SELECT 
              u.*,          
              COUNT(l.id) as count_likes
            FROM likes as l
              LEFT JOIN users as u ON u.id = l.liker_user_id
              GROUP BY u.id
            ORDER BY count_likes DESC 
        ', $this->rsm);
    }

    /**
     * Generate mapping for report
     *
     * @return ResultSetMapping
     */
    private function configureMapping(): ResultSetMapping
    {
        return (new ResultSetMapping())
            ->addScalarResult('id', 'id')
            ->addScalarResult('first_name', 'first_name')
            ->addScalarResult('last_name', 'last_name')
            ->addScalarResult('middle_name', 'middle_name')
            ->addScalarResult('count_likes', 'count_likes');
    }

    /**
     * Get count query
     *
     * @return AbstractQuery
     */
    private function countQuery(): AbstractQuery
    {
        return $this->em->createNativeQuery(
            'SELECT COUNT(DISTINCT liker_user_id) FROM likes;',
                $this->countRsm
            );
    }
}