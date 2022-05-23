<?php

namespace App\Dto;

class ProductDto
{
    public int $id;
    public string $title;
    public string $description;
    public array $categories;
    public float $price;
    public string $images;

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param array $categories
     * @param float $price
     * @param string $images
     */
    public function __construct(
        int $id,
        string $title,
        string $description,
        array $categories,
        float $price,
        string $images
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->categories = $categories;
        $this->price = $price;
        $this->images = $images;
    }


}
