<?php


namespace App\Service;


use App\Dto\ProductDto;

interface ProductServiceInterface
{
    /**
     * Truncate products table
     *
     * @return void
     */
    public function drop();

    /**
     * Store product in database
     *
     * @param ProductDto $productDto
     * @return void
     */
    public function store(ProductDto $productDto);
}