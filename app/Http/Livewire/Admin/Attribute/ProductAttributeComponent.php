<?php

namespace App\Http\Livewire\Admin\Attribute;

use App\Models\ProductAttribute;
use Livewire\Component;
use Livewire\WithPagination;
class ProductAttributeComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $attributes = ProductAttribute::paginate(15);
        return view('livewire.admin.attribute.product-attribute-component', compact('attributes'))->layout('layouts.base');
    }


    // Function For Deleting Attribute
    public function delete($attribute_id)
    {
        ProductAttribute::find($attribute_id)->delete();
        session()->flash('success_message','Product Attribute Deleted Successfully!');
    }
}
