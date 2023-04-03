<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Carbon;

class AdminDashboardComponent extends Component
{
    public function render()
    {
        $latest_orders = Order::where('created_at', 'DESC')->get()->take(10);
        $total_orders = Order::where('status', 'delivered')->count();
        $total_revenue = Order::where('status', 'delivered')->sum('total');
        $today_orders = Order::where('status', 'delivered')->whereDate('created_at', Carbon::today())->count();
        $today_revenue = Order::where('status', 'delivered')->whereDate('created_at', Carbon::today())->sum('total');

        return view('livewire.admin.admin-dashboard-component', compact('latest_orders', 'total_orders', 'total_revenue','today_orders', 'today_revenue'))->layout('layouts.base');
    }
}
