<?php

namespace Compucie\Congressus\Request;

use Compucie\Congressus\Request\ParameterType\Path;
use Compucie\Congressus\Request\ParameterType\Query;
use GuzzleHttp\Psr7\Request as Psr7Request;

class Request extends Psr7Request
{
    private string $method;
    private Parameters $parameters;
    private PathParameters $path_parameters;
    private QueryParameters $query_parameters;
    private array $allowed = array();

    public function __construct(string $method, string $path, $parameters)
    {
        $this->method = $method;
        $this->parameters = $parameters;
        $this->path_parameters = new PathParameters($path);
        $this->query_parameters = new QueryParameters();
    }

    public function allow_parameters(array $allowed): void
    {
        foreach ($allowed as $enum) {
            array_push($this->allowed, $enum->value);
        }

        $this->apply_arguments();
    }

    public function get_options(): array
    {
        return $this->query_parameters->as_option();
    }

    private function apply_arguments(): void
    {
        $parameters = $this->get_parameters(); // shorthand

        // check if all parameters are allowed
        $invalid_arguments = array_diff($parameters->get_keys(), $this->allowed);
        if (!empty($invalid_arguments)) {
            throw new \InvalidArgumentException("Invalid argument(s): " . print_r($invalid_arguments));
        }

        // route each argument value to its handler method
        foreach ($parameters->as_array() as $parameter_type => $value) {
            match ($parameter_type) {
                Path::obj_id->value => $this->path_parameters->obj_id($value),

                Query::category_id  ->value => $this->query_parameters->category_id     ($value),
                Query::context      ->value => $this->query_parameters->context         ($value),
                Query::order        ->value => $this->query_parameters->order           ($value),
                Query::page         ->value => $this->query_parameters->page            ($value),
                Query::page_size    ->value => $this->query_parameters->page_size       ($value),
                Query::period_filter->value => $this->query_parameters->period_filter   ($value[0], $value[1]),
                Query::published    ->value => $this->query_parameters->published       ($value),
                Query::status_id    ->value => $this->query_parameters->status_id       ($value),
                Query::socie_app_id ->value => $this->query_parameters->socie_app_id    ($value),
                Query::term         ->value => $this->query_parameters->term            ($value),
            };
        }

        // the parent constructor can only be called now the path parameters are handled
        parent::__construct($this->get_method(), $this->path_parameters->as_path());
    }

    private function get_method(): string
    {
        return $this->method;
    }

    private function get_parameters(): Parameters
    {
        return $this->parameters;
    }
}
