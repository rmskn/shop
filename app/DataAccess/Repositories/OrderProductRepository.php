<?php

namespace App\DataAccess\Repositories;

use App\Models\OrderProduct;

class OrderProductRepository
{
    public function getByOrderId(int $orderId): array
    {
        return OrderProduct::query()
            ->select('*')
            ->where('order_id', $orderId)
            ->get()
            ->toArray();
    }

    public function getCountOfProducts(int $orderId): int
    {
        return OrderProduct::query()
            ->where('order_id', $orderId)
            ->sum('count');
    }
}
