<?php

namespace App\Mappers;

use App\Dto\ProductListDto;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductListMapper
{
    private ProductMapper $productMapper;

    public function __construct(

        ProductMapper $productMapper
    ) {
        $this->productMapper = $productMapper;
    }

    /**
     * @param Product[] $list
     */
    public function toDto(Collection $list): ProductListDto
    {
        $dto = new ProductListDto();
        foreach ($list as $product) {

            $dto->items[] = $this->productMapper->toProductDto($product);
        }

        return $dto;
    }

}
