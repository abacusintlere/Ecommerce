<?php

namespace App\Http\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Livewire\Component;

class EditCouponComponent extends Component
{
    public $coupon_code, $coupon_type, $coupon_value, $cart_value, $coupon_id;

    // Mounted Function
    public function mount($coupon_id)
    {
        $this->coupon_id = $coupon_id;
        $coupon = Coupon::find($coupon_id);
        $this->coupon_code = $coupon->code;
        $this->coupon_type = $coupon->type;
        $this->coupon_value = $coupon->value;
        $this->cart_value = $coupon->cart_value;

    }
    public function render()
    {
        return view('livewire.admin.coupons.edit-coupon-component')->layout('layouts.base');
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

    // For Storing Category
    public function update()
    {
        $this->validate([
            'coupon_code' => 'required|unique:coupons,code',
            'coupon_type' => 'required',
            'coupon_value' => 'required|numeric',
            'cart_value' => 'required|numeric'
        ]);
        $coupon = Coupon::find($this->coupon_id);
        $coupon->code = $this->coupon_code;
        $coupon->type = $this->coupon_type;
        $coupon->value = $this->coupon_value;
        $coupon->cart_value = $this->cart_value;
        $coupon->update();

        session()->flash('success_message', 'Coupon Updated Successfully!');
    }
}
