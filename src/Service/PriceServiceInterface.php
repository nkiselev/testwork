<?php


namespace App\Service;


use App\Dto\MetalDto;
use App\Dto\PriceDto;
use App\Entity\Supplier;

interface PriceServiceInterface
{
    /**
     * @return array
     */
    public function price() : array;
}