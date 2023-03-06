<?php

namespace App\Models;

use Attribute;
use Illuminate\Support\Str;
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
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }


    public function name():Attribute
    {
        return new Attribute(
            set:fn($value)=>[
                'name' => $value,
                'slug' => Str::slug($value)
            ]
        );
    }
}
