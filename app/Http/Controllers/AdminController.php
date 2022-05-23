<?php

namespace App\Http\Controllers;

use App\DataAccess\Repositories\CategoryRepository;
use App\DataAccess\Repositories\ProductRepository;
use App\DataAccess\Repositories\SectionRepository;
use App\Service\ProductService;
use App\ViewModels\ActionResultViewModel;
use App\ViewModels\Admin\EditProductsPageViewModel;
use App\ViewModels\Admin\EditProductViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController
{
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;
    private SectionRepository $sectionRepository;
    private ProductService $productService;

    /**
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     * @param SectionRepository $sectionRepository
     * @param ProductService $productService
     */
    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        SectionRepository $sectionRepository,
        ProductService $productService
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->sectionRepository = $sectionRepository;
        $this->productService = $productService;
    }

    public function getEditProductsPage()
    {
        $products = $this->productRepository->getAllWithCategories();
        $availableCategories = $this->categoryRepository->getAllCategories();

        $view = new EditProductsPageViewModel($products, $availableCategories);
        return view('admin.edit-products', ['editProductsViewModel' => $view]);
    }

    public function getEditProductPage(Request $request)
    {
        if (!isset($request['productId'])) {
            return abort('400');
        }

        $productId = (int)$request['productId'];

        if ($this->productRepository->getById($productId) === null) {
            return abort('400');
        }

        $product = $this->productRepository->getProductWithCategories($productId);
        $allCategories = $this->sectionRepository->getAll();

        $view = new EditProductViewModel($product, $allCategories);
        return view('admin.edit-product', ['editProductViewModel' => $view]);
    }

    public function updateProduct(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|numeric',
            'title' => 'required|max:30',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'newCategoriesOfProduct' => 'required|json',
            'oldImagesOfProduct' => 'required|json',
            'newImages' => 'array',
            'newImages.*' => 'image'
        ]);

        if (isset($validated['newImages'])) {
            $oldImages = json_decode($validated['oldImagesOfProduct'], false, 512, JSON_THROW_ON_ERROR);
            $this->productService->deleteOldImages($oldImages, $validated['id']);
            $newImages = $this->productService->saveNewImages($validated['newImages'], $validated['id']);

            $images = array_merge($oldImages, $newImages);
        } else {
            $images = json_decode($validated['oldImagesOfProduct'], false, 512, JSON_THROW_ON_ERROR);
        }

        $result = $this->productRepository->update(
            $validated['id'],
            $validated['title'],
            $validated['description'],
            $validated['price'],
            json_decode($validated['newCategoriesOfProduct'], false, 512, JSON_THROW_ON_ERROR),
            $images
        );

        if ($result) {
            $viewModel = new ActionResultViewModel(
                true,
                'editProduct',
                true,
                'Product has been modified successfully!',
                [],
                'Continue',
                route('manager.edit-products')
            );
        } else {
            $viewModel = new ActionResultViewModel(
                true,
                'editProduct',
                false,
                'Something went wrong',
                [],
                'Continue',
                route('manager.edit-products')
            );
        }

        return view('action-result', ['actionResultViewModel' => $viewModel]);
    }

    public function deleteProduct(Request $request)
    {
        $validated = $request->validate([
            'productId' => 'required|numeric'
        ]);

        $result = $this->productRepository->delete($validated['productId']);

        if ($result) {
            $this->productService->removeDir($_SERVER['DOCUMENT_ROOT'] . "/images/Products/{$validated['productId']}");
            $viewModel = new ActionResultViewModel(
                true,
                'deleteProduct',
                true,
                'Product has been deleted successfully!',
                [],
                'Continue',
                route('manager.edit-products')
            );
        } else {
            $viewModel = new ActionResultViewModel(
                true,
                'deleteProduct',
                false,
                'Something went wrong',
                [],
                'Continue',
                route('manager.edit-products')
            );
        }

        return view('action-result', ['actionResultViewModel' => $viewModel]);
    }

    public function getNewProductPage()
    {
        return view('admin.new-product', ['availableCategories' => $this->sectionRepository->getAll()]);
    }

    public function createProduct(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:30',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'categories' => 'array',
            'categories.*' => 'numeric',
            'newImages' => 'array',
            'newImages.*' => 'image'
        ]);

        $images = $validated['newImages'] ?? [];
        $categories = $validated['categories'] ?? [];

        $result = $this->productRepository->create(
            $validated['title'],
            $validated['description'],
            $validated['price'],
            $categories,
            $images
        );

        if ($result !== false) {
            $this->productService->createDir($_SERVER['DOCUMENT_ROOT'] . "/images/Products/{$result}");
            if ($images !== []) {
                $this->productService->saveNewImages($validated['newImages'], $result);
            }

            $viewModel = new ActionResultViewModel(
                true,
                'createProduct',
                true,
                'Product was created successfully!',
                [],
                'Continue',
                route('manager.edit-products')
            );
        } else {
            $viewModel = new ActionResultViewModel(
                true,
                'createProduct',
                false,
                'Something went wrong',
                [],
                'Continue',
                route('manager.edit-products')
            );
        }

        return view('action-result', ['actionResultViewModel' => $viewModel]);
    }
}
