<?php

namespace App\Core\Http\Annotation;


interface HttpAnnotation
{
    /**
     * Get annotation value
     *
     * @return mixed
     */
    public function value();
}