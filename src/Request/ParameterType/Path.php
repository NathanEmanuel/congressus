<?php

namespace Compucie\Congressus\Request\ParameterType;

use Compucie\Congressus\Request\ParameterType\ParameterTypeInterface;

enum Path: string implements ParameterTypeInterface
{
    case event_id = "event_id";
    case log_entry_id = "log_entry_id";
    case member_id = "member_id";
    case membership_status_id = "membership_status_id";
    case obj_id = "obj_id";

    public function getValue(): string
    {
        return $this->value;
    }
}
