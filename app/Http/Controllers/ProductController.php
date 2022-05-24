<?php

namespace App\Http\Controllers;

use App\DataAccess\Repositories\CategoryRepository;
use App\DataAccess\Repositories\ProductRepository;
use App\Facades\AuthHelper;
use App\Mappers\ProductListMapper;
use App\ViewModels\CatalogViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;
    private ProductListMapper $productListMapper;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        ProductListMapper $productListMapper
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->productListMapper = $productListMapper;
    }

    public function getCatalogPage()
    {
        $isAuth = false;

        if (Auth::user()) {
            $isAuth = true;
        }

        $products = $this->productRepository->getAll()->toArray();

        foreach ($products as &$product) {
            $product['categories'] = $this->categoryRepository->getCategoriesOfProduct($product['id']);
        }

        $availableCategories = $this->categoryRepository->getAllCategories();

        $viewModel = new CatalogViewModel($products, $isAuth, $availableCategories);

        return view('catalog.catalog', ['catalogViewModel' => $viewModel]);
    }

    public function getApiCatalogPage()
    {
        $products = $this->productRepository->getAll();
        $dto = $this->productListMapper->toDto($products);
        return response()->json($dto);
    }
}
