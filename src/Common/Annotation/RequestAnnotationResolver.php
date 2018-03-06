<?php

namespace App\Common\Annotation;


use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;

class RequestAnnotationResolver implements AnnotationResolver
{
    /**
     * @var ControllerResolverInterface
     */
    private $resolver;

    /**
     * @var Reader
     */
    private $reader;

    public function __construct(ControllerResolverInterface $resolver, Reader $reader)
    {
        $this->resolver = $resolver;

        $this->reader = $reader;
    }

    public function resolve(Request $request, string $class)
    {
        $annotations = $this->getAnnotations($request);
        $annotations = array_filter($annotations, function ($annotation) use ($class) {
            return $class === get_class($annotation);
        });

        /** @var HttpAnnotation $annotation */
        $annotation = array_pop($annotations);
        if (null === $annotation) {
            return null;
        }

        return $annotation->value();
    }

    /**
     * Gets the group annotations from the request
     *
     * @param Request $request
     *
     * @return array
     */
    private function getAnnotations(Request $request) : array
    {
        $controller = $this->resolver->getController($request);

        if (!$controller) {
            return [];
        }

        return $this->reader->getMethodAnnotations(new \ReflectionMethod($controller, '__invoke'));
    }
}