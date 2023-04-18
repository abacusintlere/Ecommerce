<?php

namespace App\Http\Livewire\Admin\Attribute;

use App\Models\ProductAttribute;
use Livewire\Component;

class AddProductAttributeComponent extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.admin.attribute.add-product-attribute-component')->layout('layouts.base');
    }

    // Updated Hook
    public function updated($fileds)
    {
        $this->validateOnly($fileds, [
            'name' => ['required']
        ]);
    }
    // Save Attribute
    public function store()
    {
        $this->validate([
            'name' => ['required']
        ]);

        $attribute = new ProductAttribute();
        $attribute->name = $this->name;
        $attribute->save();
        
        session()->flash('success_message', 'Product Attribute Added Successfully!');
    }
}
