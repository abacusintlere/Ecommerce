<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class HeaderSearchComponent extends Component
{
    public $search, $product_cat, $product_cat_id;

    public function mount()
    {
        $this->product_cat = "All Categories";
        $this->fill(request()->only('search', 'product_cat', 'product_cat_id'));
    }

    public function render()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.header-search-component', compact('categories', 'product_cat', 'product_cat_id'));
    }
}
