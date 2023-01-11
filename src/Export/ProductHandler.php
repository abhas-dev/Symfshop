<?php

namespace App\Export;

use App\Repository\ProductRepository;
use Symfony\Component\Filesystem\Filesystem;

class ProductHandler implements ExportHandlerInterface
{
    public function __construct(private readonly ProductRepository $repository)
    {
    }

    public function supports(string $type): bool
    {
        return $type == 'product';
    }

    public function doExport(): string
    {
        $products = $this->repository->findAll();
        $productsCSV = "";
        foreach ($products as $product) {
            $productsCSV .= $product->getName()."; ". $product->getSlug()."; ".$product->getPrice().PHP_EOL;
        }

        return $productsCSV;
    }
}
