<?php

namespace App\DataAccess\Repositories;

use App\Models\Section;

class SectionRepository
{
    public function getSectionTitle(int $sectionId): string
    {
        $sectionTitle = Section::query()
            ->select('title')
            ->where('id', $sectionId)
            ->first();

        return $sectionTitle->title;
    }

    public function getAll(): array
    {
        return Section::all()->toArray();
    }
}
