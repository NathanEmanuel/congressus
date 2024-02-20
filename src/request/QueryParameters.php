<?php

namespace Compucie\Congressus\Request;

use Compucie\Congressus\Request\ParameterType\Query;

class QueryParameters extends Parameters
{
    function as_option()
    {
        return ["query" => $this->as_array()];
    }

    private function serialize_array(int|string|array $array): string
    {
        try {
            return implode(",", $array);
        } catch (\TypeError) {
            return (string) $array;
        }
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

    function folder_id(int|string|array $parameter): void
    {
        $this->add(Query::folder_id, $this->serialize_array($parameter));
    }

    function group_id(int|string|array $parameter): void
    {
        $this->add(Query::group_id, $this->serialize_array($parameter));
    }

    function member_id(int|string|array $parameter): void
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

    function parent_id(string $parameter): void
    {
        $this->add(Query::parent_id, $parameter);
    }

    function period_filter(string $parameter): void
    {
        $this->add(Query::period_filter, $parameter);
    }

    function published(bool $parameter): void
    {
        $this->add(Query::published, (int) $parameter);
    }

    function status(string $parameter): void
    {
        $this->add(Query::status, $parameter);
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
