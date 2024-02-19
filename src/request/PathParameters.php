<?php
require_once("PathParameter.php");
class PathParameters
{
    private string $path;
    private array $path_parameters;

    function __construct(string $path)
    {
        $this->path = $path;
    }

    function as_array(): array
    {
        return $this->path_parameters;
    }

    function as_path(): string
    {
        return $this->path;
    }

    function obj_id(int|string $argument): void
    {
        $this->path = str_replace("{obj_id}", $argument, $this->path);
    }
}
