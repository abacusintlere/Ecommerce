<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminEditCategoryComponent extends Component
{
    public $category_slug, $category_id, $name, $slug, $is_active, $parent_category;

    // Mount Function
    public function mount($category_slug)
    {
        $this->category_slug = $category_slug;
        $category = Category::where('slug', $category_slug)->first();
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        if($category->parent_id)
        {
            $this->parent_category = $category->parent_id;
        }
        $this->is_active = $category->is_active;
    }

    public function render()
    {
        $categories = Category::where('is_active',1)->get();
        return view('livewire.admin.category.admin-edit-category-component', compact('categories'))->layout('layouts.base');
    }

    // For Generating Slug
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name,'-');
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

    // For Updating Category
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'is_active' => 'required'
        ]);
        
        $category = Category::find($this->category_id);
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->parent_id = $this->parent_category;
        $category->is_active = $this->is_active;
        $category->update();
        session()->flash('success_message','Category Updated Successfully!');
    }
}
