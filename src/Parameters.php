<?php
require_once("PathParameters.php");
require_once("QueryParameters.php");
class Parameters
{
    private PathParameters $path_parameters;
    private QueryParameters $query_parameters;

    public function __construct(string $path)
    {
        $this->path_parameters = new PathParameters($path);
        $this->query_parameters = new QueryParameters();
    }
    public function allow(Parameter $parameter, mixed $argument): void
    {
        match ($parameter) {
            PathParameter::obj_id => $this->path_parameters->obj_id($argument),

            QueryParameter::category_id => $this->query_parameters->category_id($argument),
            QueryParameter::period_filter => $this->query_parameters->period_filter($argument[0], $argument[1]),
            QueryParameter::published => $this->query_parameters->published($argument),
            QueryParameter::order => $this->query_parameters->order($argument),
            QueryParameter::term => $this->query_parameters->term($argument),
        };
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
