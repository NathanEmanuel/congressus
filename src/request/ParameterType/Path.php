<?php

namespace Compucie\Congressus\Request\ParameterType;

use Compucie\Congressus\Request\ParameterType\ParameterTypeInterface;

enum Path: string implements ParameterTypeInterface
{
    case obj_id = "obj_id";

    public function get_value(): string
    {
        return $this->value;
    }
}
