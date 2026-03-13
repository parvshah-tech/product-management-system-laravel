<?php

namespace Database\Factories;

use App\Models\Category;
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
        $lastProduct = Product::latest()->first();

        $number = $lastProduct ? $lastProduct->id + 1 : 1;

        $random = strtoupper(substr(md5(uniqid()), 0, 6));

        $sku = 'PROD-'.$random.$number;

        $categories = Category::whereNotNull('parent_id')->pluck('id')->toArray();
        $price = fake()->randomFloat(2, 100, 100000);

        return [
            'sku' => $sku,
            'name' => fake()->words(2, true),
            'short_description' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'price' => $price,
            'sale_price' => fake()->randomFloat(2, 50, $price),
            'category_id' => fake()->randomElement($categories),
            'gallery_image' => null,
            'feature_images' => null,
        ];
    }
}
