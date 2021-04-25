<?php

namespace App\Entity;

use App\Dto\SupplierDto;
use App\Repository\SupplierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SupplierRepository::class)
 */
class Supplier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return SupplierDto
     */
    public function intoSupplierDto() : SupplierDto
    {
        $supplier = new SupplierDto();
        $supplier->setId($this->getId());
        $supplier->setName($this->getName());
        return $supplier;
    }
}
