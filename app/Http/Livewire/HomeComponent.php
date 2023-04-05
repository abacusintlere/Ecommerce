<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\HomeCategory;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeComponent extends Component
{
    public function render()
    {
        $sliders = HomeSlider::where('status', 1)->get();
        // Latedst Products
        $lproducts = Product::orderBy('created_at', 'DESC')->take(8)->get();
        // Home Categories
        $category = HomeCategory::find(1);
        $home_categories = explode(',',$category->sel_categories);
        // dd($home_categories);
        $categories = Category::whereIn('id', $home_categories)->where('is_active', 1)->get();
        // dd($categories);
        $no_of_products = $category->no_of_products;
        // Sale Products
        $sale_products = Product::where('sale_price', '>', 0)->inRandomOrder()->take(8)->get();
        // Sale
        $sale = Sale::find(1);

        if(Auth::check())
        {
            Cart::instance('cart')->restore(Auth::user()->email);
            Cart::instance('wishlist')->restore(Auth::user()->email);
        }

        return view('livewire.home-component', compact('sliders', 'lproducts', 'categories','no_of_products','sale_products', 'sale'))->layout('layouts.base');
    }
}
