<?php
require_once("QueryParameter.php");
class QueryParameters
{
    private array $query_parameters = array();

    function as_array()
    {
        return $this->query_parameters;
    }

    function as_option()
    {
        return ["query" => $this->query_parameters];
    }

    private function append(string $key, string $value)
    {
        $this->query_parameters = array_merge($this->query_parameters, [$key => $value]);
    }

    function category_id(?string $argument)
    {
        if (!is_null($argument)) {
            $this->append("category_id", $argument);
        }
    }

    function context(?string $argument)
    {
        if (!is_null($argument)) {
            $this->append("context", $argument);
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
        $this->append("period_filter", $value);
    }

    function published(bool $argument): void
    {
        if ($argument) {
            $this->append("published", "1");
        }
    }

    function order(string $argument): void
    {
        $this->append("order", $argument);
    }

    function term(string $argument): void
    {
        $this->append("term", $argument);
    }
}
