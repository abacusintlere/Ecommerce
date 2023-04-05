<?php

namespace App\Http\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;
class CouponComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $coupons = Coupon::paginate(20);
        return view('livewire.admin.coupons.coupon-component', compact('coupons'))->layout('layouts.base');
    }

    // For Deleting Coupons
    public function delete($coupon_id)
    {
        Coupon::find($coupon_id)->delete();
        session()->flash('success_message', 'Coupon Deleted Successfully!');
    }
}
