<?php

namespace App\Core\Http\Annotation;


use App\Core\Exception\InvalidArgumentException;

/**
 * Annotation class for @ResponseTransformer().
 *
 * @Annotation
 * @Target({"METHOD"})
 *
 */
class ResponseTransformer implements HttpAnnotation
{
    /**
     * @var string[]
     */
    private $class;

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

        $this->class = $data['value'];
    }

    /**
     * {@inheritdoc}
     */
    public function value()
    {
        return $this->class;
    }
}