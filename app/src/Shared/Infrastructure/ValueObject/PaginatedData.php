<?php


namespace App\Shared\Infrastructure\ValueObject;


final class PaginatedData
{
    private ?array $data;

    private int $count;


    public function __construct(
        array $data = null
    )
    {
        $this->data  = $data;
        $this->count = count($data);
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
}