<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailsComponent extends Component
{
    public $slug, $qty;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->qty = 1;
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $papular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(5)->get();
        $sale = Sale::find(1);
        return view('livewire.details-component', compact('product', 'papular_products','related_products','sale'))->layout('layouts.base');
    }

    // For Storing Product Into Cart
    public function addToCart($product_id, $product_name, $product_price)
    {
        // You can even make it a one-liner
        Cart::add($product_id, $product_name, 1, $product_price)->associate('Product');
        session()->flash("success_message", "Product Added To Cart");
        return redirect()->route('cart');
    }

    // For Increasing Quantity Into Cart
    public function increaseQuantity()
    {
        $this->qty++;
    }

    // For Decreasing Quantity Into Cart
    public function decreaseQuantity()
    {
        if($this->qty > 1)
        {
            $this->qty--;
        }
        else
        {
            $this->qty = 1;
        }
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
}
