<?php

namespace Compucie\Congressus\Request\ParameterType;

use Compucie\Congressus\Request\ParameterType\ParameterTypeInterface;

enum Path: int implements ParameterTypeInterface
{
    case obj_id = 100;

    public function get_value(): int
    {
        return $this->value;
    }
}
