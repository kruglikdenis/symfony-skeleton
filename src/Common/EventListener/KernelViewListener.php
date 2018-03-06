<?php


namespace App\Common\EventListener;


use App\Common\Annotation\AnnotationResolver;
use App\Common\Annotation\ResponseCode;
use App\Common\Annotation\ResponseGroup;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Serializer\Serializer;

class KernelViewListener
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var AnnotationResolver
     */
    private $annotationResolver;

    public function __construct(EntityManagerInterface $em, Serializer $serializer = null, AnnotationResolver $annotationResolver)
    {
        $this->em = $em;
        $this->serializer = $serializer;
        $this->annotationResolver = $annotationResolver;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $this->flushChanges();
        $this->transformResponse($event);
    }

    /**
     * Transform response data
     *
     * @param GetResponseForControllerResultEvent $event
     */
    private function transformResponse(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();
        $result = $event->getControllerResult();
        if ($result instanceof Response) {
            return;
        }

        $response = new JsonResponse();
        $response->setStatusCode($this->annotationResolver->resolve($request, ResponseCode::class) ?? 200);
        if (!is_scalar($result)) {
            $result = $this->serializer->normalize($result, $request->getRequestFormat(), [
                'groups' => $this->annotationResolver->resolve($request, ResponseGroup::class)
            ]);
        }

        $response->setData($result);
        $event->setResponse($response);
    }

    /**
     * Flush changes
     */
    private function flushChanges()
    {
        $this->em->flush();
    }
}