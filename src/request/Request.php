<?php

use GuzzleHttp\Psr7\Request as Psr7Request;

require_once("PathParameters.php");
require_once("QueryParameters.php");
class Request extends Psr7Request
{
    private string $method;
    private PathParameters $path_parameters;
    private QueryParameters $query_parameters;
    private array $allowed = array();

    public function __construct(string $method, string $path)
    {
        $this->method = $method;
        $this->path_parameters = new PathParameters($path);
        $this->query_parameters = new QueryParameters();
    }

    public function allow(array $allowed): void
    {
        foreach ($allowed as $enum => $value) {
            array_push($this->allowed, $value->value);
        }
    }

    public function handle_arguments(Arguments $arguments): void
    {
        // check if all arguments are allowed
        $invalid_arguments = array_diff($arguments->get_keys(), $this->allowed);
        if (!empty($invalid_arguments)) {
            throw new InvalidArgumentException("Invalid argument(s): " . print_r($invalid_arguments));
        }
        
        // route each argument value to its handler method
        foreach ($arguments->as_array() as $key => $value) {
            match ($key) {
                PathParameter::obj_id->value => $this->path_parameters->obj_id($value),

                QueryParameter::category_id->value => $this->query_parameters->category_id($value),
                QueryParameter::period_filter->value => $this->query_parameters->period_filter($value[0], $value[1]),
                QueryParameter::published->value => $this->query_parameters->published($value),
                QueryParameter::order->value => $this->query_parameters->order($value),
                QueryParameter::term->value => $this->query_parameters->term($value),
            };
        }

        // the parent constructor can only be called now the path arguments are handled
        parent::__construct($this->get_method(), $this->path_parameters->as_path());
    }

    private function get_method(): string {
        return $this->method;
    }

    public function get_path(): string
    {
        return $this->path_parameters->as_path();
    }

    public function get_options(): array
    {
        return $this->query_parameters->as_option();
    }
}
