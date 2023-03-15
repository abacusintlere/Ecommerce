<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{

    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
    // For Increasing Quantity Into Cart
    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty+1;
        Cart::update($rowId, $qty);
        $this->emit('cart-count-component', 'refreshComponent');

    }

    // For Decreasing Quantity Into Cart
    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty-1;
        Cart::update($rowId, $qty);
        $this->emit('cart-count-component', 'refreshComponent');

    }

    // For Deleting Product From Cart
    public function remove($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emit('cart-count-component', 'refreshComponent');
        session()->flash('success_message', "Product Deleted From Cart");
    }

    // For Deleting All Products From Cart
    public function removeAll()
    {
        Cart::instance('cart')->destroy();
        $this->emit('cart-count-component', 'refreshComponent');
        session()->flash('success_message', "Shopping Cart Cleared Successfully!");

    }
}
