<?php
class Options
{
    private array $options = ["query" => []];

    public function add_query(string $key, string $value)
    {
        $this->options["query"] = array_merge($this->options["query"], [$key => $value]);
    }

    public function as_array(): array
    {
        return $this->options;
    }
}
