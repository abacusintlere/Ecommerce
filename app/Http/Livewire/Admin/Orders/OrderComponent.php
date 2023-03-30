<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Livewire\Component;

class OrderComponent extends Component
{
    public function render()
    {
        $orders = Order::orderBy('created_at','DESC')->paginate(12);
        return view('livewire.admin.orders.order-component', compact('orders'))->layout('layouts.base');
    }

    public function changeOrderStatus($order_id, $status)
    {
        $order = Order::find($order_id);
        if($status == "delivered")
        {
            $order->delivered_date = Carbon::now();
        }
        elseif($status == "canceled")
        {
            $order->canceled_date = Carbon::now();
        }
        $order->update();
        session()->flash('order_message', 'Order Status Updated Successfully!');
    }
}
