<?php

namespace App\ViewModels\Admin;

use App\Dto\ProductDto;

class EditProductViewModel
{
    public ProductDto $product;
    public array $allCategories;

    /**
     * @param ProductDto $product
     * @param array $allCategories
     */
    public function __construct(ProductDto $product, array $allCategories)
    {
        $this->product = $product;
        $this->allCategories = $allCategories;
    }

}
