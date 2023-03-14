<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminAddProductComponent extends Component
{
    public $name, $slug, $short_desc, $desc, $regular_price, $sale_price, $sku, $stock_status, $featured, $quantity, $thumbnail, $category, $is_active;

    // Mount Function
    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured = 0;
    } 
    
    use WithFileUploads;
    public function render()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.admin.product.admin-add-product-component', compact('categories'))->layout('layouts.base');
    }

    // For Generating Product Slug
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }
    // For Storing Product
    public function store()
    {
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_desc = $this->short_desc;
        $product->desc = $this->desc;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->sku = $this->sku;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        $thumbnail = Carbon::now()->timestamp.'.'.$this->thumbnail->extension(); 
        $this->thumbnail->storeAs('products', $thumbnail);
        $product->thumbnail = $thumbnail;
        $product->category_id = $this->category;
        $product->is_active = $this->is_active;
        $product->save();
        session()->flash('success_message', 'Product Added Successfully!');
    }
}
