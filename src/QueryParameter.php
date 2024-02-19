<?php
require_once("Parameter.php");
enum QueryParameter implements Parameter
{
    case category_id;
    case period_filter;
    case published;
    case order;
    case term;
}
