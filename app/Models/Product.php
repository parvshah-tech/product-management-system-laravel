<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'short_description',
        'description',
        'price',
        'sale_price',
        'category_id',
        'gallery_image',
        'feature_images',
    ];

    // To automatically convert the feature_images attribute to an array when retrieving from the database and to JSON when saving to the database
    protected function casts(): array
    {
        return [
            'feature_images' => 'array',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
