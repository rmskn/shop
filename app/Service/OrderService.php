<?php

namespace App\Service;

class OrderService
{
    public function decodeJsonCart(string $jsonCart): array
    {
        return json_decode($jsonCart, true, 512, JSON_THROW_ON_ERROR);
    }

    public function calculateCartPrice(array $cart): float
    {
        $price = 0.0;
        foreach ($cart as $product) {
            $price += $product['price'] * $product['count'];
        }
        return $price;
    }
}
