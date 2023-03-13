<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;

class CategoryComponent extends Component
{
    use WithPagination;

    public $sorting, $pagesize, $category_slug;

    // Mount Function
    public function mount($category_slug)
    {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->category_slug = $category_slug;
    } 

    public function render()
    {
        $category = Category::where('slug', $this->category_slug)->first();
        $category_id = $category->id;
        if($this->sorting == "data")
        {
            $products = Product::where('category_id', $category_id)->where('created_at', 'DESC')->where('is_active', 1)->paginate($this->pagesize);
        }
        elseif($this->sorting == "price")
        {
            $products = Product::where('category_id', $category_id)->where('regular_price', 'ASC')->where('is_active', 1)->paginate($this->pagesize);
 
        }
        elseif($this->sorting == "price-desc")
        {
            $products = Product::where('category_id', $category_id)->where('regular_price', 'DESC')->where('is_active', 1)->paginate($this->pagesize);
        }
        else
        {
            $products = Product::where('category_id', $category_id)->paginate($this->pagesize);
 
        }
        $papular_products = Product::where('featured', true)->take(4)->get();
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.category-component', compact('products','papular_products','categories', 'category'))->layout('layouts.base');
    }

    // For Storing Product Into Cart
    public function addToCart($product_id, $product_name, $product_price)
    {
        // You can even make it a one-liner
        Cart::add($product_id, $product_name, 1, $product_price)->associate('Product');
        session()->flash("success_message", "Product Added To Cart");
        return redirect()->route('cart');
    }
}
