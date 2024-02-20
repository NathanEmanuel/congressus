<?php

namespace Compucie\Congressus\Request;

class PathParameters extends Parameters
{
    private string $path;

    function __construct(string $path)
    {
        $this->path = $path;
    }

    function as_path(): string
    {
        return $this->path;
    }

    function obj_id(int|string $parameter): void
    {
        $this->path = str_replace("{obj_id}", $parameter, $this->path);
    }
}
