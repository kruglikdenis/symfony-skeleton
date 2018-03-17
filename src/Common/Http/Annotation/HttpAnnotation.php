<?php

namespace App\Common\Http\Annotation;


interface HttpAnnotation
{
    /**
     * Get annotation value
     *
     * @return mixed
     */
    public function value();
}