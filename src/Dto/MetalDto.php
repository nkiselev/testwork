<?php


namespace App\Dto;


use App\Entity\Supplier;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class MetalDto
{
    private const MetalTypes = ['Gold', 'Silver', 'Platinum'];

    /**
     * Relation supplier Id
     *
     * @var integer
     */
    private $supplier_id;

    /**
     * Metal type name
     *
     * @var string
     */
    private $metal_type;

    /**
     * @param Supplier $supplier
     * @return MetalDto
     */
    public static function fromSupplier(Supplier $supplier) : MetalDto
    {
        $key = array_rand(self::MetalTypes);

        $metal = new MetalDto();
        $metal->setMetalType(
            self::MetalTypes[$key]
        );
        $metal->setSupplierId($supplier->getId());

        return $metal;
    }

    /**
     * @return MetalDto
     */
    public static function from(string $json) : MetalDto
    {
        $data = json_decode($json);

        $metal = new MetalDto();
        $metal->setMetalType($data->metalType ?? '');
        $metal->setSupplierId($data->supplierId ?? 0);
        return $metal;

    }

    /**
     * @return int
     */
    public function getSupplierId(): int
    {
        return $this->supplier_id;
    }

    /**
     * @param int $supplier_id
     */
    public function setSupplierId(int $supplier_id): void
    {
        $this->supplier_id = $supplier_id;
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
}