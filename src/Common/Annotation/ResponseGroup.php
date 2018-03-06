<?php

namespace App\Common\Annotation;


use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Annotation class for @ResponseGroup().
 *
 * @Annotation
 * @Target({"METHOD"})
 *
 */
class ResponseGroup extends Groups implements HttpAnnotation
{
    /**
     * {@inheritdoc}
     */
    public function value()
    {
        return $this->getGroups();
    }
}