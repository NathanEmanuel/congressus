<?php

namespace Compucie\Congressus\request;

class Arguments
{
    private array $arguments = array();

    public function add(Parameter $parameter, mixed $value): void
    {
        $this->arguments[$parameter->get_value()] = $value;
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
