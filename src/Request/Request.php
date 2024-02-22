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

    public function allowParameters(array $allowed): void
    {
        foreach ($allowed as $enum) {
            array_push($this->allowed, $enum->value);
        }

        $this->applyArguments();
    }

    public function getOptions(): array
    {
        return $this->query_parameters->asOption();
    }

    private function applyArguments(): void
    {
        $parameters = $this->getParameters(); // shorthand

        // check if all parameters are allowed
        $invalid_arguments = array_diff($parameters->getKeys(), $this->allowed);
        if (!empty($invalid_arguments)) {
            throw new \InvalidArgumentException("Invalid argument(s): " . print_r($invalid_arguments));
        }

        // route each argument value to its handler method
        foreach ($parameters->asArray() as $parameter_type => $value) {
            match ($parameter_type) {
                Path::obj_id->value => $this->path_parameters->obj_id($value),

                Query::category_id                  ->value => $this->query_parameters->category_id                     ($value),
                Query::context                      ->value => $this->query_parameters->context                         ($value),
                Query::folder_id                    ->value => $this->query_parameters->folder_id                       ($value),
                Query::group_id                     ->value => $this->query_parameters->group_id                        ($value),
                Query::member_id                    ->value => $this->query_parameters->member_id                       ($value),
                Query::order                        ->value => $this->query_parameters->order                           ($value),
                Query::page                         ->value => $this->query_parameters->page                            ($value),
                Query::page_size                    ->value => $this->query_parameters->page_size                       ($value),
                Query::parent_id                    ->value => $this->query_parameters->parent_id                       ($value),
                Query::participation_billing_enabled->value => $this->query_parameters->participation_billing_enabled   ($value),
                Query::participating_member_id      ->value => $this->query_parameters->participating_member_id         ($value),
                Query::period_filter                ->value => $this->query_parameters->period_filter                   ($value),
                Query::published                    ->value => $this->query_parameters->published                       ($value),
                Query::status                       ->value => $this->query_parameters->status                          ($value),
                Query::status_id                    ->value => $this->query_parameters->status_id                       ($value),
                Query::socie_app_id                 ->value => $this->query_parameters->socie_app_id                    ($value),
                Query::term                         ->value => $this->query_parameters->term                            ($value),
            };
        }
        
        
        // the parent constructor can only be called now the path parameters are handled
        // because the parent's method and uri fields are read-only
        parent::__construct($this->getMethod(), $this->path_parameters->asPath());
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getParameters(): Parameters
    {
        return $this->parameters;
    }
}
