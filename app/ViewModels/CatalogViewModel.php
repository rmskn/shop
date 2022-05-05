<?php

namespace App\ViewModels;

class CatalogViewModel
{
    public array $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }
}
