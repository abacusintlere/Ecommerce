<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopComponent extends Component
{
    use WithPagination;

    public $sorting, $pagesize, $min_price, $max_price;

    // Mount Function
    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->min_price = 1;
        $this->max_price = 1000;
    } 

    public function render()
    {
        if($this->sorting == "date")
        {
            $products = Product::whereBetween('regular_price',[$this->min_price, $this->max_price])->orderBy('created_at', 'DESC')->where('is_active', 1)->paginate($this->pagesize);
        }
        elseif($this->sorting == "price")
        {
            $products = Product::whereBetween('regular_price',[$this->min_price, $this->max_price])->orderBy('regular_price')->where('is_active', 1)->paginate($this->pagesize);
 
        }
        elseif($this->sorting == "price-desc")
        {
            $products = Product::whereBetween('regular_price',[$this->min_price, $this->max_price])->orderBy('regular_price', 'DESC')->where('is_active', 1)->paginate($this->pagesize);
        }
        else
        {
            $products = Product::whereBetween('regular_price',[$this->min_price, $this->max_price])->paginate($this->pagesize);
 
        }
        if(Auth::check())
        {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);

        }
        $papular_products = Product::where('featured', true)->take(4)->get();
        $categories = Category::where('is_active', 1)->whereNull('parent_id')->get();
        return view('livewire.shop-component', compact('products','papular_products','categories'))->layout('layouts.base');
    }

    // For Storing Product Into Cart
    public function addToCart($product_id, $product_name, $product_price)
    {
        // dd($product_id, $product_name, $product_price);
        // You can even make it a one-liner
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash("success_message", "Product Added To Cart Successfully!");
        return redirect()->route('cart');
    }

    // For Storing Product Into Wishlist
    public function addToWishList($product_id, $product_name, $product_price)
    {
        // You can even make it a one-liner
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('wish-list-count-component', 'refreshComponent');
        session()->flash("success_message", "Product Added To Wishlist Successfully!");
        // return redirect()->route('cart');
    }

    // Removing Product From Wishlist
    public function removeWishList($productId)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if($witem->id == $productId)
            {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wish-list-count-component', 'refreshComponent');
                session()->flash('success_message', "Product Deleted From Wishlist");
            }
        }
       
    }
}
