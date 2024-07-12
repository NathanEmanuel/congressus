<?php

namespace Compucie\Congressus;

use GuzzleHttp\Psr7\Request as Psr7Request;

class Request extends Psr7Request
{
    private array $args;
    private array $options = array(); // query, json

    public function __construct(private string $method, private string $path, array $args)
    {
        foreach ($args as $key => $value) {
            if (is_object($value)) {
                $args[$key] = self::sanitizeObject($value);
            } elseif (is_array($value)) {
                $args[$key] = self::sanitizeArray($value);
            }
        }
        $this->setArgs($args);

        // wait with calling the parent's constructor until the parameters are set
    }

    private static function sanitizeObject(object $object): object
    {
        $object = (object) array_filter((array) ObjectSerializer::sanitizeForSerialization($object));
        foreach ($object as $key => $value) {
            if (is_object($value)) {
                $object->$key = self::sanitizeObject($value);
            } elseif (is_array($value)) {
                $object->$key = self::sanitizeArray($value);
            }
        }
        return $object;
    }

    private static function sanitizeArray(array $array): array
    {
        $array = array_filter($array);
        foreach ($array as $key =>  $value) {
            if (is_object($value)) {
                $array[$key] = self::sanitizeObject($value);
            } elseif (is_array($value)) {
                $array[$key] = self::sanitizeArray($value);
            }
        }
        return $array;
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
                $search = "{{$param}}";
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

        $this->setOption("query", self::buildQueryString($query));
    }

    private static function buildQueryString(array $query): string
    {
        $queryString = "";
        foreach ($query as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $param) {
                    $queryString .= "&$key=$param";
                }
            } else {
                $queryString .= "&$key=$value";
            }
        }
        return $queryString;
    }

    public function enableBodyFields(...$bodyFields): void
    {
        $body = array();
        foreach ($bodyFields as $field) {
            try {
                $body[$field] = $this->getArg($field);
            } catch (\TypeError) {
                continue;
            }
        }
        $this->setOption("json", $body);
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

    private function setArgs(array $args): void
    {
        $this->args = $args;
    }

    private function getArg(string $key): string|array
    {
        return $this->getArgs()[$key];
    }
}
