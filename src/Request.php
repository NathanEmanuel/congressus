<?php

namespace Compucie\Congressus;

use GuzzleHttp\Psr7\Request as Psr7Request;

class Request extends Psr7Request
{
    private array $options = array();

    public function __construct(private string $method, private string $path, private array $parameters)
    {
        $this->applyParameters($parameters);

        // the parent constructor can only be called now the path parameters are handled
        // because the parent's method and uri fields are read-only
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

    private function applyParameters(array $parameters): void
    {
        $remaining_parameters = $this->applyPathParameters($parameters);
        $this->setQueryParameters($remaining_parameters);
    }

    private function applyPathParameters(array $parameters): array
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
        return $parameters;
    }

    private function setQueryParameters(array $parameters): void
    {
        $options = $this->getOptions();
        $options["query"] = $parameters;
        $this->setOptions($options);
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
