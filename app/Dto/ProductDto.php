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



    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ProductDto
     */
    public function setId(int $id): ProductDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return ProductDto
     */
    public function setTitle(string $title): ProductDto
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return ProductDto
     */
    public function setDescription(string $description): ProductDto
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     * @return ProductDto
     */
    public function setCategories(array $categories): ProductDto
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return ProductDto
     */
    public function setPrice(float $price): ProductDto
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getImages(): string
    {
        return $this->images;
    }

    /**
     * @param string $images
     * @return ProductDto
     */
    public function setImages(string $images): ProductDto
    {
        $this->images = $images;
        return $this;
    }

}
