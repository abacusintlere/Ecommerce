<?php

namespace App\Http\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Livewire\Component;

class AddCouponComponent extends Component
{
    public $coupon_code, $coupon_type, $coupon_value, $cart_value;

    public function render()
    {
        return view('livewire.admin.coupons.add-coupon-component')->layout('layouts.base');
    }

    // Updated Hook
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'coupon_code' => 'required|unique:coupons,code',
            'coupon_type' => 'required',
            'coupon_value' => 'required|numeric',
            'cart_value' => 'required|numeric'
        ]);
    }

    // For Storing Coupon
    public function store()
    {
        $this->validate([
            'coupon_code' => 'required|unique:coupons,code',
            'coupon_type' => 'required',
            'coupon_value' => 'required|numeric',
            'cart_value' => 'required|numeric'
        ]);
        $coupon = new Coupon();
        $coupon->code = $this->coupon_code;
        $coupon->type = $this->coupon_type;
        $coupon->value = $this->coupon_value;
        $coupon->cart_value = $this->cart_value;
        $coupon->save();

        session()->flash('success_message', 'Coupon Created Successfully!');
    }
}
