<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
class AdminAddCategoryComponent extends Component
{
    public $name,$slug,$is_active, $parent_category;
    public function render()
    {
        $categories = Category::where('is_active',1)->get();
        return view('livewire.admin.category.admin-add-category-component', compact('categories'))->layout('layouts.base');
    }

    // For Generating Slug
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }
    // Updated Hook
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'is_active' => 'required'
        ]);
    }

    // For Storing Category
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'is_active' => 'required'
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->parent_id = $this->parent_category;
        $category->is_active = $this->is_active;
        $category->save();
        session()->flash('success_message', 'Category Added Successfully!');
    }
}
