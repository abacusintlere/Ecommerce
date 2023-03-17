<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{

    public function render()
    {
        $products = Product::where('is_active', 1)->take(8)->get();
        return view('livewire.cart-component', compact('products'))->layout('layouts.base');
    }
    // For Increasing Quantity Into Cart
    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty+1;
        Cart::update($rowId, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');

    }

    // For Decreasing Quantity Into Cart
    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty-1;
        Cart::update($rowId, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');

    }

    // For Deleting Product From Cart
    public function remove($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success_message', "Product Deleted From Cart");
    }

    // For Deleting All Products From Cart
    public function removeAll()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success_message', "Shopping Cart Cleared Successfully!");

    }
}
