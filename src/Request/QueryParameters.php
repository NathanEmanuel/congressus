<?php

namespace Compucie\Congressus\Request;

use Compucie\Congressus\Request\ParameterType\Query;

class QueryParameters extends Parameters
{
    function asOption()
    {
        return ["query" => $this->asArray()];
    }

    private function serializeArray(int|string|array $array): string
    {
        try {
            return implode(",", $array);
        } catch (\TypeError) {
            return (string) $array;
        }
    }


    // Parameter serialization functions
    // These are in underscore_case to match Congressus's definitions

    function category_id(int|string|array $parameter): void
    {
        $this->add(Query::category_id, $this->serializeArray($parameter));
    }

    function context(string|array $parameter): void
    {
        $this->add(Query::context, $this->serializeArray($parameter));
    }

    function folder_id(int|string|array $parameter): void
    {
        $this->add(Query::folder_id, $this->serializeArray($parameter));
    }

    function group_id(int|string|array $parameter): void
    {
        $this->add(Query::group_id, $this->serializeArray($parameter));
    }

    function member_id(int|string|array $parameter): void
    {
        $this->add(Query::member_id, $this->serializeArray($parameter));
    }

    function order(string $parameter): void
    {
        $this->add(Query::order, $parameter);
    }

    function page(int|string $parameter): void
    {
        $this->add(Query::page, $parameter);
    }

    function page_size(int|string $parameter): void
    {
        $this->add(Query::page, $parameter);
    }

    function parent_id(int|string $parameter): void
    {
        $this->add(Query::parent_id, $parameter);
    }

    function participation_billing_enabled(string|array $parameter): void
    {
        $this->add(Query::participation_billing_enabled, $this->serializeArray($parameter));
    }

    function participating_member_id(int|string|array $parameter): void
    {
        $this->add(Query::participating_member_id, $this->serializeArray($parameter));
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

    function status_id(int|string|array $parameter): void
    {
        $this->add(Query::status_id, $this->serializeArray($parameter));
    }

    function socie_app_id(int|string|array $parameter): void
    {
        $this->add(Query::socie_app_id, $this->serializeArray($parameter));
    }

    function term(string $parameter): void
    {
        $this->add(Query::term, $parameter);
    }
}
