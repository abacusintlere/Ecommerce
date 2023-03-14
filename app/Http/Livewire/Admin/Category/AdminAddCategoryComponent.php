<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
class AdminAddCategoryComponent extends Component
{
    public $name,$slug,$status;
    public function render()
    {
        return view('livewire.admin.category.admin-add-category-component')->layout('layouts.base');
    }

    // For Generating Slug
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    // For Storing Category
    public function store()
    {
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->is_active = $this->status;
        $category->save();
        session()->flash('success_message', 'Category Added Successfully!');
    }
}
