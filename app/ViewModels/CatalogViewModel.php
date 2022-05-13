<?php

namespace App\ViewModels;

class CatalogViewModel
{
    public array $products;
    public bool $auth;
    public array $availableCategories;

    public function __construct(array $products, int $auth, array $availableCategories)
    {
        $this->products = $products;
        $this->auth = $auth;
        $this->availableCategories = $availableCategories;
    }
}
