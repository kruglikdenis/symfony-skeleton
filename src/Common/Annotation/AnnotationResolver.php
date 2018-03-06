<?php

namespace App\Common\Annotation;


use Symfony\Component\HttpFoundation\Request;

interface AnnotationResolver
{
    public function resolve(Request $request, string $class);
}