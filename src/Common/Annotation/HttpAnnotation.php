<?php

namespace App\Common\Annotation;


interface HttpAnnotation
{
    /**
     * Get annotation value
     *
     * @return mixed
     */
    public function value();
}