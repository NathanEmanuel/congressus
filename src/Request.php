<?php

namespace Compucie\Congressus;

use GuzzleHttp\Psr7\Request as Psr7Request;

class Request extends Psr7Request
{
    private array $options = array(); // query, json

    public function __construct(private string $method, private string $path, private array $parameters)
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

    private function setOption(string $key, mixed $value): void
    {
        $options = $this->getOptions();
        $options[$key] = $value;
        $this->setOptions($options);
    }

    public function setPathParameters(...$parameters): void
    {
        $path = $this->getPath();

        preg_match_all("/\{[a-z_]*\}/", $path, $matches);
        foreach ($matches[0] as $match) {
            foreach ($parameters as $key => $value) {
                if (str_contains($match, $key)) {
                    $path = str_replace($match, $value, $path);
                    unset($parameters[$key]);
                }
            }
        }

        $this->setPath($path);
    }

    public function setQueryParameters(...$parameters): void
    {
        $this->setOption("query", $parameters[0]);
    }

    public function setBody(...$body): void
    {
        $this->setOption("json", $body);
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    private function getPath(): string
    {
        return $this->path;
    }

    private function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}
