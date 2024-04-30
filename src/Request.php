<?php

namespace Compucie\Congressus;

use GuzzleHttp\Psr7\Request as Psr7Request;

class Request extends Psr7Request
{
    private array $options = array(); // query, json

    public function __construct(private string $method, private string $path, private array $args)
    {
        // wait with calling the parent's constructor until the parameters are set
    }

    public function finalize(): void
    {
        // the parent constructor can only be called now the parameters are handled
        // because the parent's fields are read-only apart from the headers field
        parent::__construct($this->getMethod(), $this->getPath());
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    private function setOptions(array $options): void
    {
        $this->options = $options;
    }

    public function setOption(string $key, mixed $value): void
    {
        $options = $this->getOptions();
        $options[$key] = $value;
        $this->setOptions($options);
    }

    public function enablePathParameters(...$parameters): void
    {
        $path = $this->getPath();
        $args = $this->getArgs();

        foreach ($parameters as $param) {
            if (array_key_exists($param, $args)) {
                $search = "{" . $param . "}";
                $path = str_replace($search, $args[$param], $path);
            }
        }

        $this->setPath($path);
    }

    public function enableQueryParameters(...$parameters): void
    {
        $query = array();

        foreach ($parameters as $param) {
            try {
                $query[$param] = $this->getArg($param);
            } catch (\TypeError) {
                continue;
            }
        }

        $this->setOption("query", $query);
    }

    public function enableBodyFields(...$body): void
    {
        $json = array();

        foreach ($body as $param) {
            try {
                $json[$param] = $this->getArg($param);
            } catch (\TypeError) {
                continue;
            }
        }

        $this->setOption("json", $json);
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    private function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getArgs(): array
    {
        return $this->args;
    }

    private function getArg(string $key): string
    {
        return $this->getArgs()[$key];
    }
}
