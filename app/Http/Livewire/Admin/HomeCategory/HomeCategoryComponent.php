<?php

namespace App\Http\Livewire\Admin\HomeCategory;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class HomeCategoryComponent extends Component
{
    public $selected_categories=[], $no_of_products, $category_id;

    // Mount Function
    public function mount()
    {
        $category = HomeCategory::first();
        $this->category_id = $category->id;
        $this->selected_categories = explode(',', $category->sel_categories);
        $this->no_of_products = $category->no_of_products;

    }

    public function render()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.admin.home-category.home-category-component', compact('categories'))->layout('layouts.base');
    }

    // Function For Update
    public function update()
    {
        $category = HomeCategory::find($this->category_id);
        $category->sel_categories = implode(',', $this->selected_categories);
        $category->no_of_products = $this->no_of_products;
        $category->update();

        session()->flash('success_message','Home Category Updated Successfully!');
    }
}
