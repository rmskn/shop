<?php

namespace App\Dto;

class OrderProductDto
{
    public int $id;
    public string $title;
    public string $description;
    public float $priceInOrder;
    public float $priceInDb;
    public float $count;
    public string $pictures;
    public array $categories;

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param float $priceInOrder
     * @param float $priceInDb
     * @param float $count
     * @param string $pictures
     * @param array $categories
     */
    public function __construct(
        int $id,
        string $title,
        string $description,
        float $priceInOrder,
        float $priceInDb,
        float $count,
        string $pictures,
        array $categories
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->priceInOrder = $priceInOrder;
        $this->priceInDb = $priceInDb;
        $this->count = $count;
        $this->pictures = $pictures;
        $this->categories = $categories;
    }


}
