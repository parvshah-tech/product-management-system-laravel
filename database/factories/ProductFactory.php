<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Electronics',
            'Clothing',
            'Furniture',
            'Books',
        ];

        $subcategories = [
            'Mobile',
            'Laptop',
            'T-Shirt',
            'Chair',
            'Table',
            'Novel',
        ];

        return [
            'name' => fake()->words(2, true),
            'description' => fake()->paragraph(),
            'category' => fake()->randomElement($categories),
            'subcategory' => fake()->randomElement($subcategories),
            'price' => fake()->randomFloat(2, 100, 100000),
            'sale_price' => fake()->randomFloat(2, 50, 99999),
            'gallery_image' => null,
            'feature_images' => null,
        ];
    }
}
