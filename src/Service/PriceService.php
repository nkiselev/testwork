<?php


namespace App\Service;


use App\Dto\PriceDto;
use Symfony\Component\Yaml\Yaml;

class PriceService implements PriceServiceInterface
{
    private $price;

    public function __construct($price)
    {
        $this->price = $price;
    }

    public function price(): array
    {
        $price = Yaml::parseFile($this->price);
        return ! empty($price['price']) && is_iterable($price['price'])
            ? $price['price']
            : [];
    }
}