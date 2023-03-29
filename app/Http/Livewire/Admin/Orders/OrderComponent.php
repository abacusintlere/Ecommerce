<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class OrderComponent extends Component
{
    public function render()
    {
        $orders = Order::orderBy('created_at','DESC')->paginate(12);
        return view('livewire.admin.orders.order-component', compact('orders'))->layout('layouts.base');
    }
}
