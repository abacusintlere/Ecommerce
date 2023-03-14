<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class AdminCategoryComponent extends Component
{
    public function render()
    {
        $categories = Category::paginate(12);
        return view('livewire.admin.admin-category-component', compact('categories'))->layout('layouts.base');
    }
}
