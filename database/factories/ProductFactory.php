<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Название модели, соответствующей фабрике.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->text(100),
            'price' => $this->faker->randomFloat(2, 0, 50),
            'pictures' => json_encode(
                ['test_img.jpg'],
                JSON_THROW_ON_ERROR
            )
        ];
    }
}
