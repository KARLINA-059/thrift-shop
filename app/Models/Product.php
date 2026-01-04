<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'description',
        'price',
        'size',
        'condition',
        'image',
        'stock',
        'category_id',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the product's image URL with fallback
     */
    public function getImageUrlAttribute()
    {
        if (! $this->image) {
            // No image specified
            return null;
        }

        // If it's already a full URL, return it
        if (filter_var($this->image, FILTER_VALIDATE_URL) || Str::startsWith($this->image, 'http')) {
            return $this->image;
        }

        // Helper to safely encode path segments and return asset URL
        $encodeAsset = function ($path) {
            $path = ltrim($path, '/');
            $segments = explode('/', $path);
            $segments = array_map('rawurlencode', $segments);
            return asset(implode('/', $segments));
        };

        // If image contains an images/ path or starts with a slash, assume it's a public path
        if (Str::contains($this->image, 'images/') || Str::startsWith($this->image, '/')) {
            return $encodeAsset($this->image);
        }

        // Check common public folders (encode filename to handle spaces/special chars)
        if (file_exists(public_path('images/products/' . $this->image))) {
            return $encodeAsset('images/products/' . $this->image);
        }

        if (file_exists(public_path('images/' . $this->image))) {
            return $encodeAsset('images/' . $this->image);
        }

        // Fallback to a default product image based on category
        $fallbackImages = [
            'product-1.jpg', // Atasan
            'product-2.jpg', // Outer
            'product-3.jpg', // Dress
            'product-4.jpg', // Celana
            'product-5.jpg', // Aksesoris
        ];

        $categoryIndex = 0;
        if ($this->category) {
            switch ($this->category->name) {
                case 'Atasan':
                    $categoryIndex = 0;
                    break;
                case 'Outer':
                    $categoryIndex = 1;
                    break;
                case 'Dress':
                    $categoryIndex = 2;
                    break;
                case 'Celana':
                    $categoryIndex = 3;
                    break;
                case 'Aksesoris':
                    $categoryIndex = 4;
                    break;
            }
        }

        return asset('images/products/' . $fallbackImages[$categoryIndex]);
    }

    /**
     * Get fallback image URL
     */
    public static function getFallbackImageUrl()
    {
        return asset('images/no-image.jpg');
    }
}