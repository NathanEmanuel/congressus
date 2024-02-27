<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model\PaginationMetadata;

class Page extends PaginationMetadata
{
    public function __construct(
        private mixed $pagination,
        private string $caller,
        private array $parameters,
    ) {
        parent::__construct(array(
            "total" => $pagination->getTotal(),
            "previous_page" => $pagination->getPrevNum(),
            "next_page" => $pagination->getNextNum(),
        ));
    }

    private function getPagination(): mixed
    {
        return $this->pagination;
    }

    /**
     * Return the client's method that was called to request this page.
     */
    public function getCaller(): string
    {
        return $this->caller;
    }

    /**
     * Return the parameters that yielded this page.
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function hasPrevious(): bool
    {
        return $this->getPagination()->getHasPrev();;
    }

    public function hasNext(): bool
    {
        return $this->getPagination()->getHasNext();
    }

    public function getData(): mixed
    {
        return $this->getPagination()->getData();
    }
}
