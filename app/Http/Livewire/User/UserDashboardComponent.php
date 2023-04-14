<?php

namespace App\Http\Livewire\User;

use Carbon\Carbon;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserDashboardComponent extends Component
{
    public function render()
    {
        $my_orders = Order::where('user_id', Auth::user()->id)->get()->take(10);
        $total_cost = Order::where('status', '!=', 'canceled')->where('user_id', Auth::user()->id)->sum('total');
        $total_purchased = Order::where('status', '!=', 'canceled')->where('user_id', Auth::user()->id)->count();
        $total_delivered = Order::where('status', 'delivered')->where('user_id', Auth::user()->id)->count();
        $today_canceled = Order::where('status', 'canceled')->where('user_id', Auth::user()->id)->sum('total');

        return view('livewire.user.user-dashboard-component', compact('my_orders', 'total_cost', 'total_purchased','total_delivered', 'today_canceled'))->layout('layouts.base');
    }
}
