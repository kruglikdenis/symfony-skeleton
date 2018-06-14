<?php

namespace App\Core\Http;


class Filter
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var mixed
     */
    private $value;

    public function __construct(string $field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }
}