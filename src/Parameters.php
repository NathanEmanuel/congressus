<?php
interface Parameters
{
    public function allow(PathParameter $parameter, mixed $argument): void;
    public function as_array(): array;
}
