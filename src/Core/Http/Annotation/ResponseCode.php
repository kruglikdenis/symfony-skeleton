<?php

namespace App\Core\Http\Annotation;

use App\Core\Exception\InvalidArgumentException;

/**
 * Annotation class for @ResponseCode().
 *
 * @Annotation
 * @Target({"METHOD"})
 *
 */
class ResponseCode implements HttpAnnotation
{
    /**
     * @var string[]
     */
    private $code;

    /**
     * ResponseCode constructor.
     * @param array $data
     * @throws InvalidArgumentException
     */
    public function __construct(array $data)
    {
        if (!isset($data['value']) || !$data['value']) {
            throw new InvalidArgumentException(sprintf('Parameter of annotation "%s" cannot be empty.', \get_class($this)));
        }

        $this->code = (int) $data['value'];
    }

    /**
     * {@inheritdoc}
     */
    public function value()
    {
        return $this->code;
    }
}
