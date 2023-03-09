<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
class ShopComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $products = Product::where('is_active', 1)->paginate(12);
        $papular_products = Product::where('featured', true)->take(4)->get();
        return view('livewire.shop-component', compact('products','papular_products'))->layout('layouts.base');
    }
}
