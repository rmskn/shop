<?php

namespace App\Dto;

class ProductListDto
{
    /**
     * @var ProductDto[]
     */
    public array $items;

//    /**
//     * @param ProductDto[] $list
//     */
//    public static function toDto(array $list) : ProductListMapper {
//        $return = new ProductListMapper();
//
//
//
//        foreach ($list as $product) {
//            $product['categories'] = $this->categoryRepository->getCategoriesOfProduct($product['id']);
//            $return->list[] = $product;
//        }
//
//        return new ProductListMapper();
//    }

}
