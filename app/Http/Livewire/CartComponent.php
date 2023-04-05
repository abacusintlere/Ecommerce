<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{

    public $haveCouponCode, $couponCode, $discount, $subtotalAfterDiscount, $taxAfterDiscount, $totalAfterDiscount;
    public function render()
    {
        if(session()->has('coupon'))
        {
            if(Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value'])
            {
                session()->forget('coupon');
            }
            else{
                $this->calculateDiscount();
            }
        }
        $this->setAmountForCheckout();
        $products = Product::where('is_active', 1)->take(8)->get();
        
        if(Auth::check())
        {
            Cart::instance('cart')->store(Auth::user()->email);
        }

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

    // For Saving Cart Item Into Save for later
    public function saveForLater($rowId)
    {
        $item = Cart::instance('cart')->get($rowId);
        Cart::instance('cart')->remove($rowId);
        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('s_success_message', "Product has been Saved for Later Successfully!");
    }

    // For Moving Product From Save Later To Cart
    public function moveToCart($rowId)
    {
        $item = Cart::instance('saveForLater')->get($rowId);
        Cart::instance('saveForLater')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('s_success_message', "Product has been Added To Cart Successfully!");
    }

    // Delete Product From Saved Later
    public function deleteFromSavedLater($rowId)
    {
        Cart::instance('saveForLater')->remove($rowId);
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('s_success_message', "Product Deleted From Saved Later");
    }

    // Apply Coupon Code
    public function applyCouponCode()
    {
        $coupon = Coupon::where('code', $this->couponCode)->where('cart_value', '<=', Cart::instance('cart')->where('expiry_date', '>=', Carbon::today())->subtotal())->first();
        if(!$coupon)
        {
            session()->flash('coupon_message', 'Invalid Coupon Code');
            return;
        }

        session()->put('coupon',[
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);
    }

    // Calculate Discount
    public function calculateDiscount()
    {
        if(Session::has('coupon'))
        {
            if(Session::get('coupon')['type'] == 'fixed')
            {
                $this->discount = session()->get('coupon')['value'];
            }
            else{
                $this->discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value'])/100;
            }   

            $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;
            $this->taxAfterDiscount = ($this->subtotalAfterDiscount * config('cart.tax'))/100;
            $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
    }

    // Remove Coupon
    public function removeCoupon()
    {
        session()->forget('coupon');
    }

    // Checkout
    public function checkout()
    {
        if(Auth::check())
        {
            return redirect()->route('checkout');
        }
        else
        {
            return redirect()->route('login');
        }
    }

    // Set Amount For Checkout
    public function setAmountForCheckout()
    {
        if(!Cart::instance('cart')->count() > 0)
        {
            session()->forget('checkout');
            return;
        }

        if(session()->has('coupon'))
        {
            session()->put('checkout', [
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'tax' => $this->taxAfterDiscount,
                'total' => $this->totalAfterDiscount
            ]);
        }
        else{

            session()->put('checkout', [
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('tax')->subtotal(),
                'total' => Cart::instance('total')->subtotal()
            ]);
        }
    }
}
