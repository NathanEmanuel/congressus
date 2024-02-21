<?php

namespace Compucie\Congressus\Request;

use Compucie\Congressus\Request\ParameterType\ParameterTypeInterface;

class Parameters
{
    private array $parameters = array();

    public function add(ParameterTypeInterface $type, mixed $value): void
    {
        $this->parameters[$type->get_value()] = $value;
    }

    public function as_array(): array
    {
        return $this->parameters;
    }
    
    public function get_keys(): array
    {
        return array_keys($this->as_array());
    }

    public function get(ParameterTypeInterface $type): mixed
    {
        return $this->parameters[$type->value] ?? null;
    }
}
