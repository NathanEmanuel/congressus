<?php

namespace Compucie\Congressus\Request;

use Compucie\Congressus\Request\ParameterType\ParameterTypeInterface;

class Parameters
{
    private array $arguments = array();

    public function add(ParameterTypeInterface $type, mixed $value): void
    {
        $this->arguments[$type->get_value()] = $value;
    }

    public function get_keys(): array
    {
        return array_keys($this->arguments);
    }

    public function as_array(): array
    {
        return $this->arguments;
    }
}
