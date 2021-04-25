<?php


namespace App\Service;


use App\Dto\SupplierDto;

interface SupplierServiceInterface
{
    /**
     * @return SupplierDto[]
     */
    function list() : array;
}