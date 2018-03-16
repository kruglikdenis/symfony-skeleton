<?php

namespace App\Common\Http;

use Fesor\RequestObject\ErrorResponseProvider;
use Fesor\RequestObject\PayloadResolver;
use Fesor\RequestObject\RequestObject as BaseRequestObject;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class RequestObject extends BaseRequestObject implements ErrorResponseProvider, PayloadResolver
{
    public function getErrorResponse(ConstraintViolationListInterface $errors)
    {
        return new JsonResponse(
            [
                'status_code' => 422,
                'message' => 'Invalid data in request body',
                'errors' => array_map(function (ConstraintViolation $violation) {
                    return [
                        'path' => $violation->getPropertyPath(),
                        'message' => $violation->getMessage(),
                    ];
                }, iterator_to_array($errors)),
            ],
            422
        );
    }

    /**
     * Map request parameters to request object
     *
     * @param Request $request
     */
    public function map(Request $request): void
    {

    }

    public function resolvePayload(Request $request)
    {
        $this->map($request);

        return $this->shouldNotHasRequestBody($request->getMethod())
            ? $request->query->all()
            : array_merge(
                $request->request->all(),
                $request->files->all()
            );
    }

    /**
     * @param $methodName
     * @return bool
     */
    private function shouldNotHasRequestBody($methodName)
    {
        return in_array($methodName, ['GET', 'HEAD', 'DELETE'], true);
    }
}