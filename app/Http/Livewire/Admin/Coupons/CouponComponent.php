<?php

namespace App\Http\Livewire\Admin\Coupons;

use Livewire\Component;

class CouponComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.coupons.coupon-component')->layout('layouts.base');
    }
}
