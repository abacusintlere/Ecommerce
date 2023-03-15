<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;
class AdminEditProductComponent extends Component
{
    public $name, $slug, $short_desc, $desc, $regular_price, $sale_price, $sku, $stock_status, $featured, $quantity, $thumbnail, $category, $is_active, $product_id, $newImage;

    // Mount Function
    public function mount($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_desc = $product->short_desc;
        $this->desc = $product->desc;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->sku = $product->sku;
        $this->stock_status = $product->stock_status;
        $this->featured = $product->featured;
        $this->quantity =  $product->quantity;
        $this->thumbnail = $product->thumbnail;
        $this->category = $product->category;
        $this->is_active = $product->is_active;
    } 

    // Generate Slug
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    use WithFileUploads;
    public function render()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.admin.product.admin-edit-product-component', compact('categories'))->layout('layouts.base');
    }
    
    // Updated Hook
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required',
            'short_desc' => 'required',
            'desc' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'sku' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            'thumbnail' => 'required|mimes:png,jpg',
            'category_id' => 'required',
            'is_active' => 'required',
        ]);
    }

    // Updating Products
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'short_desc' => 'required',
            'desc' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'sku' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            'thumbnail' => 'required|mimes:png,jpg',
            'category_id' => 'required',
            'is_active' => 'required',
        ]);
        $product = Product::find($this->product_id);
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
        if($this->newImage)
        {
            $thumbnail = Carbon::now()->timestamp.'.'.$this->thumbnail->extension(); 
            $this->thumbnail->storeAs('products', $thumbnail);
            $product->thumbnail = $thumbnail;
        }

        $product->category_id = $this->category;
        $product->is_active = $this->is_active;
        $product->update();

        session()->flash('success_message', 'Product Updated Successfully!');
    }


}
