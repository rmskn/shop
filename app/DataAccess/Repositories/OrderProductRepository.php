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

    public function create(int $orderId, int $productId, float $count, float $price)
    {
        $orderProduct = new OrderProduct();
        $orderProduct->order_id = $orderId;
        $orderProduct->product_id = $productId;
        $orderProduct->price = $price;
        $orderProduct->count = $count;
        $orderProduct->save();
    }
}
