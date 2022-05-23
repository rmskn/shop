<?php

namespace App\ViewModels\Admin;

class EditProductsPageViewModel
{
    public array $products;
    public array $availableCategories;

    /**
     * @param array $products
     * @param array $availableCategories
     */
    public function __construct(array $products, array $availableCategories)
    {
        $this->products = $products;
        $this->availableCategories = $availableCategories;
    }


}
