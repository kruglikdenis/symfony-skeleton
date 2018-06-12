<?php


namespace App\Core\EventListener;


use App\Core\Exception\UnableFindTransformerException;
use App\Core\Http\Annotation\AnnotationResolver;
use App\Core\Http\Annotation\ResponseCode;
use App\Core\Http\Annotation\ResponseTransformer;
use App\Core\Http\Presenter;
use App\Core\Http\Transformer;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

class KernelViewListener
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Presenter
     */
    private $presenter;

    /**
     * @var AnnotationResolver
     */
    private $annotationResolver;

    public function __construct(ContainerInterface $container, Presenter $presenter, AnnotationResolver $annotationResolver)
    {
        $this->container = $container;
        $this->presenter = $presenter;
        $this->annotationResolver = $annotationResolver;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();

        $result = $event->getControllerResult();
        if ($result instanceof Response) {
            return;
        }

        $code = $this->code($request);
        if (null == $result) {
            $event->setResponse(new Response(null, $code));
            return;
        }

        $transformer = $this->transformer($request);
        $response = new JsonResponse(
            $this->presenter->resource($result, $transformer),
            $code
        );

        $event->setResponse($response);
    }

    /**
     * @param Request $request
     * @throws UnableFindTransformerException
     *
     * @return Transformer
     */
    private function transformer(Request $request): Transformer
    {
        $class = $this->annotationResolver->resolve($request, ResponseTransformer::class);
        if (null === $class) {
            throw new UnableFindTransformerException();
        }

        /** @var Transformer $transformer */
        $transformer = $this->container->get($class, ContainerInterface::NULL_ON_INVALID_REFERENCE);
        if (null === $transformer) {
            throw new UnableFindTransformerException();
        }

        return $transformer;
    }

    /**
     * @param Request $request
     * @return int
     */
    private function code(Request $request): int
    {
        return $this->annotationResolver->resolve($request, ResponseCode::class) ?? Response::HTTP_OK;
    }
}