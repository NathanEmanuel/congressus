<?php
require_once 'QueryParameter.php';
class QueryParameters
{
    private array $query_parameters = array();

    public function allow(QueryParameter $parameter, mixed $argument)
    {
        switch ($parameter) {
            case QueryParameter::category_id:
                $this->category_id($argument);
                break;
            case QueryParameter::period_filter:
                $this->period_filter($argument[0], $argument[1]);
                break;
            case QueryParameter::published:
                $this->published($argument);
                break;
            case QueryParameter::order:
                $this->order($argument);
                break;
            case QueryParameter::term:
                $this->term($argument);
                break;
            default:
                // ignore
                break;
        }
    }

    public function as_array()
    {
        return $this->query_parameters;
    }

    public function as_option()
    {
        return ["query" => $this->query_parameters];
    }

    private function append(string $key, string $value)
    {
        $this->query_parameters = array_merge($this->query_parameters, [$key => $value]);
    }

    private function category_id(?string $argument)
    {
        if (!is_null($argument)) {
            $this->append("category_id", $argument);
        }
    }

    private function period_filter(?int $period_start, ?int $period_end): void
    {
        if (!is_null($period_start) && !is_null($period_end)) {
            $value = date("Ymd", $period_start) . ".." . date("Ymd", $period_end);
        } elseif (is_null($period_start) && !is_null($period_end)) {
            $value = date("Ymd", time()) . ".." . date("Ymd", $period_end);
        } elseif (!is_null($period_start) && is_null($period_end)) {
            $value = date("Ymd", time()) . ".." . date("Ymd", 2147483647);;
        } else {
            return;
        }
        $this->append("period_filter", $value);
    }

    private function published(bool $argument): void
    {
        if ($argument) {
            $this->append("published", "1");
        }
    }

    private function order(string $argument): void
    {
        $this->append("order", $argument);
    }

    private function term(string $argument): void
    {
        $this->append("term", $argument);
    }
}
