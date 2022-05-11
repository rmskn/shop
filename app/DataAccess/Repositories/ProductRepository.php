<?php

namespace App\DataAccess\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll()
    {
        return Product::all()->toArray();
    }

    public function getById(int $id)
    {
        return Product::query()->find($id)->toArray();
    }

}
