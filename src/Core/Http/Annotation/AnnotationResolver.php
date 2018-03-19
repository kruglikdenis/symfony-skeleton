<?php

namespace App\Core\Http\Annotation;


use Symfony\Component\HttpFoundation\Request;

interface AnnotationResolver
{
    public function resolve(Request $request, string $class);
}