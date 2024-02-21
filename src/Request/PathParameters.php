<?php

namespace Compucie\Congressus\Request;

class PathParameters extends Parameters
{
    private string $path;

    function __construct(string $path)
    {
        $this->path = $path;
    }

    function asPath(): string
    {
        return $this->path;
    }


    // Parameter serialization functions
    // These are in underscore_case to match Congressus's definitions

    function obj_id(int|string $parameter): void
    {
        $this->path = str_replace("{obj_id}", $parameter, $this->path);
    }
}
