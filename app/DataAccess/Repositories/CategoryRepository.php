<?php

namespace App\DataAccess\Repositories;

use App\Models\Category;

class CategoryRepository
{
    private SectionRepository $sectionRepository;

    public function __construct(SectionRepository $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
    }

    public function getCategoriesOfProduct(int $productId): array
    {
        $categories = [];

        $sectionsCodes = Category::query()
            ->select('section_id')
            ->where('product_id', $productId)
            ->get();

        foreach ($sectionsCodes as $section) {
            $categories[] = [
                'code' => $section->section_id,
                'title' => $this->sectionRepository->getSectionTitle($section->section_id)
            ];
        }

        return $categories;
    }

    public function getAllCategories(): array
    {
        $categories = [];

        $sectionsCodes = Category::query()
            ->select('section_id')
            ->distinct()
            ->get();

        foreach ($sectionsCodes as $section) {
            $categories[] = [
                'code' => $section->section_id,
                'title' => $this->sectionRepository->getSectionTitle($section->section_id)
            ];
        }

        return $categories;
    }

    public function updateCategoriesOfProduct(array $categories, int $productId): void
    {
        $this->deleteCategoriesOfProduct($productId);

        foreach ($categories as $category) {
            $newCat = new Category();
            $newCat['product_id'] = $productId;
            $newCat['section_id'] = $category;
            $newCat->save();
        }
    }

    public function deleteCategoriesOfProduct(int $productId)
    {
        Category::query()
            ->where('product_id', $productId)
            ->delete();
    }

}
