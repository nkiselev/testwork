<?php


namespace App\Service;


use App\Dto\ProductDto;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProductService implements ProductServiceInterface
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ProductRepository $productRepository, EntityManagerInterface $em)
    {
        $this->productRepository = $productRepository;
        $this->em = $em;
    }

    public function store(ProductDto $productDto)
    {
        $product = $this->productRepository->findOneBy([
            'supplier_id' => $productDto->getId(),
            'metal_type' => $productDto->getMetalType(),
        ]);

        if ($product == null) {
            $product = new Product();
        }

        $product
            ->setSupplierId($productDto->getId())
            ->setName($productDto->getName())
            ->setMetalType($productDto->getMetalType())
            ->setPrice($productDto->getPrice());

        $this->em->persist($product);
        $this->em->flush();
    }

    public function drop()
    {
        $connection = $this->em->getConnection();
        $platform   = $connection->getDatabasePlatform();

        $connection->executeUpdate($platform->getTruncateTableSQL('product', true /* whether to cascade */));
    }
}