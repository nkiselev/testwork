<?php


namespace App\Dto;


class ProductDto
{
    /**
     * Supplier Id
     *
     * @var integer
     */
    private $id;

    /**
     * Supplier name
     *
     * @var string
     */
    private $name;

    /**
     * Product type
     *
     * @var string
     */
    private $metal_type;

    /**
     * Price
     *
     * @var float
     */
    private $price;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

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

    public static function from(SupplierDto $supplier, MetalDto $metal, array $price)
    {
        $product = new ProductDto();
        $product->setId($supplier->getId());
        $product->setName($supplier->getName());
        $product->setMetalType($metal->getMetalType());
        $product->setPrice($price[$metal->getMetalType()] ?? 0);

        return $product;
    }
}