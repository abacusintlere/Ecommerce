<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;

class SearchComponent extends Component
{
    use WithPagination;

    public $sorting, $pagesize, $product_cat, $product_cat_id;

    // Mount Function
    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->fill(request()->only('search','product_cat','product_cat_id'));

    } 

    public function render()
    {
        if($this->sorting == "data")
        {
            $products = Product::where('name','like','%'. $this->search.'%')
            ->whereHas('category', function($q){
                $q->where('name', 'like','%'. $this->product_cat);
            })
            ->where('created_at', 'DESC')
            ->where('is_active', 1)
            ->paginate($this->pagesize);
        }
        elseif($this->sorting == "price")
        {
            $products = Product::where('name','like','%'. $this->search.'%')
            ->whereHas('category', function($q){
                $q->where('name', 'like','%'. $this->product_cat);
            })
            ->where('regular_price', 'ASC')
            ->where('is_active', 1)->paginate($this->pagesize);
 
        }
        elseif($this->sorting == "price-desc")
        {
            $products = Product::where('name','like','%'. $this->search.'%')
            ->whereHas('category', function($q){
                $q->where('name', 'like','%'. $this->product_cat);
            })->where('regular_price', 'DESC')
            ->where('is_active', 1)->paginate($this->pagesize);
        }
        else
        {
            $products = Product::where('name','like','%'. $this->search.'%')
            ->whereHas('category', function($q){
                $q->where('name', 'like','%'. $this->product_cat);
            })->paginate($this->pagesize);
 
        }
        $papular_products = Product::where('featured', true)->take(4)->get();
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.shop-component', compact('products','papular_products','categories'))->layout('layouts.base');
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
