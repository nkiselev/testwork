<?php

namespace App\Command;

use App\Dto\ProductDto;
use App\Dto\SupplierDto;
use App\Repository\ProductRepository;
use App\Service\MetalService;
use App\Service\MetalServiceInterface;
use App\Service\PriceService;
use App\Service\PriceServiceInterface;
use App\Service\ProductServiceInterface;
use App\Service\SupplierServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeProductsCommand extends Command
{
    protected static $defaultName = 'app:make-products';
    protected static $defaultDescription = 'Make products from different sources';

    /**
     * @var SupplierServiceInterface
     */
    private $supplierService;

    /**
     * @var MetalServiceInterface
     */
    private $metalService;

    /**
     * @var PriceServiceInterface
     */
    private $priceService;

    /**
     * @var ProductServiceInterface
     */
    private $productService;

    public function __construct(SupplierServiceInterface $supplierService,
                                MetalServiceInterface $metalService,
                                PriceServiceInterface $priceService,
                                ProductServiceInterface $productService)
    {
        parent::__construct();

        $this->supplierService = $supplierService;
        $this->metalService = $metalService;
        $this->priceService = $priceService;
        $this->productService = $productService;
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->info("Drop Product table");
        $this->productService->drop();

        $prices = $this->priceService->price();

        $suppliers_list = $this->supplierService->list();
        (new ArrayCollection($suppliers_list))
            ->map(function(SupplierDto $supplier) use ($prices, $io) {
                $metal = $this->metalService->metal($supplier->getId());

                $product = ProductDto::from($supplier, $metal, $prices);
                $this->productService->store($product);

                $io->info("Product {$product->getName()} was added");
            });

        $io->success('Success');
        return Command::SUCCESS;
    }
}
