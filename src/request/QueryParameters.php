<?php

namespace Compucie\Congressus\Request;

use Compucie\Congressus\Request\ParameterType\Query;

class QueryParameters extends Parameters
{
    function as_option()
    {
        return ["query" => $this->as_array()];
    }

    private function serialize_array(array $array): string
    {
        return implode(",", $array);
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

    function group_id(array $parameter): void
    {
        $this->add(Query::group_id, $this->serialize_array($parameter));
    }

    function member_id(array $parameter): void
    {
        $this->add(Query::member_id, $this->serialize_array($parameter));
    }


    function order(string $parameter): void
    {
        $this->add(Query::order, $parameter);
    }

    function page(string $parameter): void
    {
        $this->add(Query::page, $parameter);
    }

    function page_size(string $parameter): void
    {
        $this->add(Query::page, $parameter);
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

    function status_id(string $parameter): void
    {
        $this->add(Query::status_id, $parameter);
    }

    function socie_app_id(string $parameter): void
    {
        $this->add(Query::socie_app_id, $parameter);
    }

    function term(string $parameter): void
    {
        $this->add(Query::term, $parameter);
    }
}
