<?php

namespace App\ViewModels;

class CatalogViewModel
{
    public array $products;
    public bool $auth;

    public function __construct(array $products, int $auth)
    {
        $this->products = $products;
        $this->auth = $auth;
    }
}
