<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class OrderDetailsComponent extends Component
{
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }
    public function render()
    {
        $order = Order::find($this->order_id);
        return view('livewire.admin.orders.order-details-component', compact('order'))->layout('layouts.base');
    }
}
