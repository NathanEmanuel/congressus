<?php
require_once("Parameter.php");
enum QueryParameter: int implements Parameter
{
    case category_id = 200;
    case period_filter = 201;
    case published = 202;
    case order = 203;
    case term = 204;

    public function get_value(): int
    {
        return $this->value;
    }
}
