<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OrderDetailsComponent extends Component
{
    public $order_id;

    // Mount Hook
    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function render()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('order_id', $this->order_id)->first();
        return view('livewire.user.order-details-component', compact('order'))->layout('layouts.base');
    }

    // Cancel Order
    public function cancleOrder($order_id)
    {
        $order = Order::find($order_id);
        $order->status = "canceled";
        $order->canceled_date = Carbon::now();
        $order->update();
        session()->flash('order_message', 'Order Has Been Canceled');
    }
}
