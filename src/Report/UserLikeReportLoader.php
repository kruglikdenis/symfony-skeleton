<?php

namespace App\Report;


class UserLikeReportLoader extends DataLoader
{
    public function load(): array
    {
    }

    protected function configureMapping(): void
    {
        $this->rsm->addScalarResult('id', 'id');
    }
}