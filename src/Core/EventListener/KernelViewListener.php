<?php


namespace App\Core\EventListener;


use App\Core\Http\Annotation\AnnotationResolver;
use App\Core\Http\Annotation\ResponseCode;
use App\Core\Http\Annotation\ResponseGroups;
use BornFree\TacticianDoctrineDomainEvent\EventListener\CollectsEventsFromAllEntitiesManagedByUnitOfWork;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Serializer\Serializer;

class KernelViewListener
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
        $this->transformResponse($event);
    }

    /**
     * Transform response data
     *
     * @param GetResponseForControllerResultEvent $event
     */
    private function transformResponse(GetResponseForControllerResultEvent $event): void
    {
        $request = $event->getRequest();
        $result = $event->getControllerResult();
        if ($result instanceof Response) {
            return;
        }

        $format = $request->getRequestFormat();
        if (!$this->serializer->supportsEncoding($format)) {
            return;
        }

        $code = $this->annotationResolver->resolve($request, ResponseCode::class) ?? 200;
        $context = [
            'groups' => $this->annotationResolver->resolve($request, ResponseGroups::class)
        ];
        $data = $this->serializer->normalize($result, $format, $context);
        $event->setResponse(
            new Response($this->serializer->serialize($data, $format, $context), $code)
        );
    }
}