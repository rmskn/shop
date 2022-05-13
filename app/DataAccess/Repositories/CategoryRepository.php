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
}
