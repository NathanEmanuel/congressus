<?php

namespace Compucie\Congressus\Request\ParameterType;

use Compucie\Congressus\Request\ParameterType\ParameterTypeInterface;

enum Query: string implements ParameterTypeInterface
{
    case category_id = "category_id";
    case context = "context";
    case period_filter = "period_filter";
    case published = "published";
    case order = "order";
    case term = "term";

    public function get_value(): string
    {
        return $this->value;
    }
}
