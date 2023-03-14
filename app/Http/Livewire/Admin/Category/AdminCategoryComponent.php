<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
class AdminCategoryComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $categories = Category::paginate(12);
        return view('livewire.admin.category.admin-category-component', compact('categories'))->layout('layouts.base');
    }

    // For Deleting Category
    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('success_message','Product Category Deleted Successfully!');
    }
}
