<?php

namespace App\Dto;

use App\Models\OrderProduct;

class OrderDto
{
    public int $id;
    public float $price;
    public int $statusCode;
    public string $statusTitle;
    public string $date;
    public float $totalCount;

    /**
     * @var OrderProduct[]
     */
    public array $products;

    /**
     * @param int $id
     * @param float $price
     * @param int $statusCode
     * @param string $statusTitle
     * @param string $date
     * @param float $totalCount
     * @param OrderProduct[] $products
     */
    public function __construct(
        int $id,
        float $price,
        int $statusCode,
        string $statusTitle,
        string $date,
        float $totalCount,
        array $products
    ) {
        $this->id = $id;
        $this->price = $price;
        $this->statusCode = $statusCode;
        $this->statusTitle = $statusTitle;
        $this->date = $date;
        $this->totalCount = $totalCount;
        $this->products = $products;
    }
}
