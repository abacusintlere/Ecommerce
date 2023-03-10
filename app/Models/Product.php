<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_desc',
        'description',
        'regular_price',
        'sale_price',
        'sku',
        'stock_status',
        'featured',
        'quantity',
        'thumbnail',
        'images',
        'category_id',
        'is_active'
    ];

    public function getNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    // A Product Belongs to a Particular Category
    public function category()
    {
        $this->belongsTo(Category::class,'category_id', 'id');
    }
}
