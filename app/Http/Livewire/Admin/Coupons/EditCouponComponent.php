<?php

namespace App\Http\Livewire\Admin\Coupons;

use Livewire\Component;

class EditCouponComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.coupons.edit-coupon-component')->layout('layouts.base');
    }
}
