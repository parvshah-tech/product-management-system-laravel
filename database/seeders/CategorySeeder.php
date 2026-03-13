<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::create([
            'name' => 'Electronics',
        ]);

        $clothing = Category::create([
            'name' => 'Clothing',
        ]);

        $home = Category::create([
            'name' => 'Home & Kitchen',
        ]);

        $beauty = Category::create([
            'name' => 'Beauty',
        ]);

        Category::create([
            'name' => 'Mobile Phones',
            'parent_id' => $electronics->id,
        ]);

        Category::create([
            'name' => 'Laptops',
            'parent_id' => $electronics->id,
        ]);

        Category::create([
            'name' => 'Headphones',
            'parent_id' => $electronics->id,
        ]);

        Category::create([
            'name' => 'Cameras',
            'parent_id' => $electronics->id,
        ]);

        Category::create([
            'name' => "Men's Wear",
            'parent_id' => $clothing->id,
        ]);

        Category::create([
            'name' => "Women's Wear",
            'parent_id' => $clothing->id,
        ]);

        Category::create([
            'name' => "Kid's Wear",
            'parent_id' => $clothing->id,
        ]);

        Category::create([
            'name' => 'Activewear',
            'parent_id' => $clothing->id,
        ]);

        Category::create([
            'name' => 'Cookware',
            'parent_id' => $home->id,
        ]);

        Category::create([
            'name' => 'Furniture',
            'parent_id' => $home->id,
        ]);

        Category::create([
            'name' => 'Bedding',
            'parent_id' => $home->id,
        ]);

        Category::create([
            'name' => 'Home Decor',
            'parent_id' => $home->id,
        ]);

        Category::create([
            'name' => 'Skincare',
            'parent_id' => $beauty->id,
        ]);

        Category::create([
            'name' => 'Makeup',
            'parent_id' => $beauty->id,
        ]);

        Category::create([
            'name' => 'Haircare',
            'parent_id' => $beauty->id,
        ]);

        Category::create([
            'name' => 'Fragrances',
            'parent_id' => $beauty->id,
        ]);
    }
}
