<?php

namespace Compucie\Congressus;

class Page
{
    private bool $hasPrevious;
    private int $previousPageNumber;
    private bool $hasNext;
    private int $nextPageNumber;
    private array $data;
    private int $total;

    public function __construct(
        mixed $responseBody,
        private string $caller,
        private array $parameters,
    ) {
        $this->setHasPrevious($responseBody["has_prev"]);
        $this->setPreviousPageNumber($responseBody["prev_num"]);
        $this->setHasNext($responseBody["has_next"]);
        $this->setNextPageNumber($responseBody["next_num"]);
        $this->setData($responseBody["data"]);
        $this->setTotal($responseBody["total"]);
    }

    /**
     * Get the value of hasPrevious
     */
    public function hasPrevious(): bool
    {
        return $this->hasPrevious;
    }

    /**
     * Set the value of hasPrevious
     */
    public function setHasPrevious(bool $hasPrevious): self
    {
        $this->hasPrevious = $hasPrevious;

        return $this;
    }

    /**
     * Get the value of previousPageNumber
     */
    public function getPreviousPageNumber(): int
    {
        return $this->previousPageNumber;
    }

    /**
     * Set the value of previousPageNumber
     */
    public function setPreviousPageNumber(int $previousPageNumber): self
    {
        $this->previousPageNumber = $previousPageNumber;

        return $this;
    }

    /**
     * Get the value of hasNext
     */
    public function hasNext(): bool
    {
        return $this->hasNext;
    }

    /**
     * Set the value of hasNext
     */
    public function setHasNext(bool $hasNext): self
    {
        $this->hasNext = $hasNext;

        return $this;
    }

    /**
     * Get the value of nextPageNumber
     */
    public function getNextPageNumber(): int
    {
        return $this->nextPageNumber;
    }

    /**
     * Set the value of nextPageNumber
     */
    public function setNextPageNumber(int $nextPageNumber): self
    {
        $this->nextPageNumber = $nextPageNumber;

        return $this;
    }

    /**
     * Get the value of data
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Set the value of data
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of total
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * Set the value of total
     */
    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get the value of caller
     */
    public function getCaller(): string
    {
        return $this->caller;
    }

    /**
     * Get the value of parameters
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}
