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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    // A Product Belongs to a Particular Category
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id', 'id')->whereNull('parent_id');
    }

    // A Product Belongs to a Particular Subcategory
    public function sub_category()
    {
        return $this->belongsTo(Category::class, 'subcategory_id', 'id')->WhereNotNull('parent_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_item_id', 'id');
    }
}
