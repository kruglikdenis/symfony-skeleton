<?php


namespace App\Common\EventListener;


use App\Common\Annotation\AnnotationResolver;
use App\Common\Annotation\ResponseCode;
use App\Common\Annotation\ResponseGroup;
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
            'groups' => $this->annotationResolver->resolve($request, ResponseGroup::class)
        ];
        $data = $this->normalize($result, $format, $context);
        $event->setResponse(
            new Response($this->serializer->serialize($data, $format, $context), $code)
        );
    }


    private function normalize($data, string $format, array $context = [])
    {
        if (is_iterable($data)) {
            if ($data instanceof \Traversable) {
                $data = iterator_to_array($data);
            }

            $bad = array_filter($data, function ($item) use ($format) {
                if (!is_object($item)) {
                    return true;
                }

                if (!$this->serializer->supportsNormalization($item, $format)) {
                    return true;
                }

                return false;
            });

            if (!count($bad)) {
                $data = array_map(function ($item) use ($format, $context) {
                    return $this->serializer->normalize($item, $format, $context);
                }, $data);
            }
        }

        if (is_object($data) && !$this->serializer->supportsNormalization($data, $format)) {
            return null;
        }

        return $data;
    }

    /**
     * Flush changes
     */
    private function flushChanges()
    {
        $this->em->flush();
    }
}