<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ShopComponent extends Component
{
    public function render()
    {
        $products = Product::where('is_active', 1)->paginate(20);
        return view('livewire.shop-component', compact('products'))->layout('layouts.base');
    }
}
