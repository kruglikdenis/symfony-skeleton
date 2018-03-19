<?php

namespace App\Core\Http\Annotation;


use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Annotation class for @ResponseGroups().
 *
 * @Annotation
 * @Target({"METHOD"})
 *
 */
class ResponseGroups extends Groups implements HttpAnnotation
{
    /**
     * {@inheritdoc}
     */
    public function value()
    {
        return $this->getGroups();
    }
}