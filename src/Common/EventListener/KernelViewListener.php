<?php


namespace App\Common\EventListener;


use App\Common\Annotation\AnnotationResolver;
use App\Common\Annotation\ResponseCode;
use App\Common\Annotation\ResponseGroups;
use Doctrine\ORM\EntityManagerInterface;
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

    /**
     * Flush changes
     */
    private function flushChanges()
    {
        $this->em->flush();
    }
}