<?php

namespace Compucie\Congressus\Request\ParameterType;

use Compucie\Congressus\Request\ParameterType\ParameterTypeInterface;

enum Query: int implements ParameterTypeInterface
{
    case category_id = 200;
    case context = 205;
    case period_filter = 201;
    case published = 202;
    case order = 203;
    case term = 204;

    public function get_value(): int
    {
        return $this->value;
    }
}
