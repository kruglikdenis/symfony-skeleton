<?php


namespace App\Common\EventListener;


use App\Common\Annotation\AnnotationResolver;
use App\Common\Annotation\ResponseCode;
use App\Common\Annotation\ResponseGroup;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Serializer\Serializer;

class JsonResponseTransformerListener
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var AnnotationResolver
     */
    private $annotationResolver;

    public function __construct(Serializer $serializer = null, AnnotationResolver $annotationResolver)
    {
        $this->serializer = $serializer;
        $this->annotationResolver = $annotationResolver;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();
        $result = $event->getControllerResult();
        if ($result instanceof Response) {
            return;
        }

        $response = new JsonResponse();
        $response->setStatusCode($this->annotationResolver->resolve($request, ResponseCode::class) ?? 200);
        if (!is_scalar($result)) {
            $result = $this->getSerializer()->normalize($result, $request->getRequestFormat(), [
                'groups' => $this->annotationResolver->resolve($request, ResponseGroup::class)
            ]);
        }

        $response->setData($result);
        $event->setResponse($response);
    }

    private function getSerializer()
    {
        if (null === $this->serializer) {
            throw new \BadMethodCallException('You should enable `serializer` in `config.yml` to get this work');
        }

        return $this->serializer;
    }


}