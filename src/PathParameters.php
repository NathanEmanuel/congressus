<?php
class PathParameters implements Parameters
{
    private string $path;
    private array $path_parameters;

    public function __construct(string $path)
    {
        $this->path = $path;
    }
    public function allow(PathParameter $parameter, mixed $argument): void
    {
        match ($parameter) {
            PathParameter::obj_id => $this->obj_id($argument),
        };
    }

    public function as_array(): array {
        return $this->path_parameters;
    }

    public function as_path(): string {
        return $this->path;
    }

    private function obj_id(string $argument): void
    {
        $this->path = str_replace("{obj_id}", "{$argument}", $this->path);
    }
}
