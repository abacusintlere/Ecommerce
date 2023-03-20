<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistComponent extends Component
{
    public function render()
    {
        return view('livewire.wishlist-component')->layout('layouts.base');
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

    // Moving Product From WisthList To Cart
    public function moveProductToWishlist($rowID)
    {
        $item = Cart::instance('wishlist')->get($rowID);
        Cart::instance('wishlist')->remove($rowID);
        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
        $this->emitTo('wish-list-count-component', 'refreshComponent');
        $this->emitTo('cart-count-component', 'refreshComponent');
    }
}
