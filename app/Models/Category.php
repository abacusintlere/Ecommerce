<?php

namespace App\Models;

use Attribute;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'is_active'
    ];


    public function sub_categories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->WhereNotNull('parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function sub_category_products()
    {
        return $this->hasMany(Product::class, 'subcategory_id', 'id');
    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
        $this->attributes['slug'] = Str::slug($value);
    }

}
