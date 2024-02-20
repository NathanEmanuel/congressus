<?php

namespace Compucie\Congressus\request;

enum PathParameter: int implements Parameter
{
    case obj_id = 100;

    public function get_value(): int
    {
        return $this->value;
    }
}
