<?php


namespace App\Service;


use App\Dto\MetalDto;
use App\Entity\Supplier;

interface MetalServiceInterface
{
    /**
     * @param Supplier $supplier
     * @return MetalDto
     */
    public function metal(Supplier $supplier) : MetalDto;
}