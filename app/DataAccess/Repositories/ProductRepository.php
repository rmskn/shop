<?php

namespace App\DataAccess\Repositories;

use App\Dto\ProductDto;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use PDOException;

class ProductRepository
{
    private CategoryRepository $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return Product::all()->toArray();
    }

    public function getById(int $id)
    {
        $product = Product::query()->find($id);
        if ($product === null) {
            return null;
        }

        return $product->toArray();
    }

    /**
     * @return ProductDto[]
     */
    public function getAllWithCategories()
    {
        $products = $this->getAll();
        $productsWithCat = [];
        foreach ($products as $product) {
            $productsWithCat[] = $this->getProductWithCategories($product['id']);
        }
        return $productsWithCat;
    }

    /**
     * @param int $id
     * @return ProductDto
     */
    public function getProductWithCategories(int $id): ProductDto
    {
        $product = $this->getById($id);
        $categories = $this->categoryRepository->getCategoriesOfProduct($id);
        return new ProductDto(
            $product['id'],
            $product['title'],
            $product['description'],
            $categories,
            $product['price'],
            $product['pictures']
        );
    }

    public function update(
        int $id,
        string $title,
        string $description,
        float $price,
        array $categories,
        array $pictures
    ): bool {
        try {
            DB::beginTransaction();

            $product = Product::query()->find($id);
            $product['title'] = $title;
            $product['description'] = $description;
            $product['price'] = $price;
            $product['pictures'] = json_encode($pictures, JSON_THROW_ON_ERROR);

            $this->categoryRepository->updateCategoriesOfProduct($categories, $id);

            $product->save();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return false;
        }

        return true;
    }

    public function delete(int $productId): bool
    {
        try {
            DB::beginTransaction();
            Product::query()
                ->where('id', $productId)
                ->delete();

            $this->categoryRepository->deleteCategoriesOfProduct($productId);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return false;
        }

        return true;
    }

    public function create(string $title, string $description, float $price, array $categories, array $pictures): bool|int
    {
        try {
            DB::beginTransaction();

            $product = new Product();

            $product['title'] = $title;
            $product['description'] = $description;
            $product['price'] = $price;
            $product['pictures'] = json_encode($pictures, JSON_THROW_ON_ERROR);

            $product->save();

            $this->categoryRepository->updateCategoriesOfProduct($categories, $product->id);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return false;
        }

        return $product->id;
    }
}
