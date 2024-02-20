<?php

namespace Compucie\Congressus\Request;

use Compucie\Congressus\Request\ParameterType\Query;

class QueryParameters extends Parameters
{
    function as_option()
    {
        return ["query" => $this->as_array()];
    }

    function category_id(?string $parameter)
    {
        if (!is_null($parameter)) {
            $this->add(Query::category_id, $parameter);
        }
    }

    function context(?string $parameter)
    {
        if (!is_null($parameter)) {
            $this->add(Query::context, $parameter);
        }
    }

    function period_filter(?int $period_start, ?int $period_end): void
    {
        if (!is_null($period_start) && !is_null($period_end)) {
            $value = date("Ymd", $period_start) . ".." . date("Ymd", $period_end);
        } elseif (is_null($period_start) && !is_null($period_end)) {
            $value = date("Ymd", time()) . ".." . date("Ymd", $period_end);
        } elseif (!is_null($period_start) && is_null($period_end)) {
            $value = date("Ymd", time()) . ".." . date("Ymd", 2147483647);
        } else {
            return;
        }
        $this->add(Query::period_filter, $value);
    }

    function published(bool $parameter): void
    {
        if ($parameter) {
            $this->add(Query::published, "1");
        }
    }

    function order(string $parameter): void
    {
        $this->add(Query::order, $parameter);
    }

    function term(string $parameter): void
    {
        $this->add(Query::term, $parameter);
    }
}
