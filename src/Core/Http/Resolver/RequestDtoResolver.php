<?php

namespace App\Core\Http\Resolver;

use App\Core\Exception\ValidationException;
use App\Core\Http\RequestDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestDtoResolver implements ArgumentValueResolverInterface
{
    /**
     * @var DenormalizerInterface
     */
    private $denormalizer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(DenormalizerInterface $denormalizer, ValidatorInterface $validator)
    {
        $this->denormalizer = $denormalizer;
        $this->validator = $validator;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return is_subclass_of($argument->getType(), RequestDto::class);
    }

    /**
     * @param Request $request
     * @param ArgumentMetadata $argument
     *
     * @return \Generator
     *
     * @throws ValidationException
     */
    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $data = $this->resolvePayload($request);

        /** @var RequestDto $dto */
        $dto = $this->denormalizer->denormalize($data, $argument->getType());

        $this->validateDTO($dto);

        yield $dto;
    }

    /**
     * @param RequestDto $dto
     *
     * @throws ValidationException
     */
    private function validateDto(RequestDto $dto)
    {
        $errors = $this->validator->validate($dto);
        if (0 !== count($errors)) {
            throw new ValidationException($errors);
        }
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function resolvePayload(Request $request)
    {
        return $this->shouldNotHasRequestBody($request->getMethod())
            ? $request->query->all()
            : array_merge(
                $request->request->all(),
                $request->files->all()
            );
    }

    /**
     * @param $methodName
     *
     * @return bool
     */
    private function shouldNotHasRequestBody($methodName)
    {
        return in_array($methodName, ['GET', 'HEAD', 'DELETE'], true);
    }
}
