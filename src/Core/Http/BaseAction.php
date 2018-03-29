<?php

namespace App\Core\Http;


class BaseAction implements FlushAwareInterface
{
    use FlushAwareTrait;

    public function __destruct()
    {
        $this->flushChanges();
    }
}