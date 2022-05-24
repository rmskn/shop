<?php

namespace App\Mappers;

use App\DataAccess\Repositories\CategoryRepository;
use App\Dto\ProductDto;
use App\Models\Product;

class ProductMapper
{
    private CategoryRepository $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Product $product
     */
    public  function toProductDto(Product $product): ProductDto {
        $categories = $this->categoryRepository->getCategoriesOfProduct($product->id);
        return new ProductDto(
            $product['id'],
            $product['title'],
            $product['description'],
            $categories,
            $product['price'],
            $product['pictures']
        );
    }
}
