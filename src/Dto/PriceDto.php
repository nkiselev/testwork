<?php


namespace App\Dto;


class PriceDto
{
    /**
     * Relation to metal type
     *
     * @var string
     */
    private $metal_type;

    /**
     * Metal price
     *
     * @var float
     */
    private $price;

    /**
     * @return string
     */
    public function getMetalType(): string
    {
        return $this->metal_type;
    }

    /**
     * @param string $metal_type
     */
    public function setMetalType(string $metal_type): void
    {
        $this->metal_type = $metal_type;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}