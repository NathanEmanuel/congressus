<?php

namespace Compucie\Congressus\Request;

use Compucie\Congressus\Request\ParameterType\ParameterTypeInterface;

class Parameters
{
    private array $parameters = array();

    public function add(ParameterTypeInterface $type, mixed $value): void
    {
        $this->parameters[$type->getValue()] = $value;
    }

    public function asArray(): array
    {
        return $this->parameters;
    }
    
    public function getKeys(): array
    {
        return array_keys($this->asArray());
    }

    public function get(ParameterTypeInterface $type): mixed
    {
        return $this->parameters[$type->value] ?? null;
    }
}
