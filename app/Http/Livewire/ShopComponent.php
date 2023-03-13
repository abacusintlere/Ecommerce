<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $products = Product::where('is_active', 1)->paginate(12);
        $papular_products = Product::where('featured', true)->take(4)->get();
        return view('livewire.shop-component', compact('products','papular_products'))->layout('layouts.base');
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
