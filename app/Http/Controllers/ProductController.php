<?php

namespace App\Http\Controllers;

use App\DataAccess\Repositories\CategoryRepository;
use App\DataAccess\Repositories\ProductRepository;
use App\ViewModels\CatalogViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function getCatalogPage()
    {
        $isAuth = false;

        if (Auth::user()) {
            $isAuth = true;
        }

        $products = $this->productRepository->getAll();

        foreach ($products as &$product) {
            $product['categories'] = $this->categoryRepository->getCategoriesOfProduct($product['id']);
        }

        $viewModel = new CatalogViewModel($products, $isAuth);

        return view('catalog.catalog', ['catalogViewModel' => $viewModel]);
    }

    private function getShoppingCart()
    {

    }
}
