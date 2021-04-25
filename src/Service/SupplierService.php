<?php


namespace App\Service;


use App\Dto\SupplierDto;
use App\Entity\Supplier;
use App\Repository\SupplierRepository;
use Doctrine\Common\Collections\ArrayCollection;

class SupplierService implements SupplierServiceInterface
{
    private $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * @return SupplierDto[]
     */
    function list(): array
    {
        $suppliers = $this->supplierRepository->findAll();
        return (new ArrayCollection($suppliers))
            ->map(function(Supplier $supplier) {
                return $supplier->intoSupplierDto();
            })
            ->getValues();
    }
}