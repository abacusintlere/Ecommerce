<?php

namespace App\Http\Livewire\Admin\Attribute;

use App\Models\ProductAttribute;
use Livewire\Component;

class EditProductAttributeComponent extends Component
{
    public $name, $attribute_id;

    // Mount Hook
    public function mount($attribute_id)
    {
        $attribute = ProductAttribute::find($attribute_id);
        $this->attribute_id = $attribute_id;
        $this->name = $attribute->name;
    }
    public function render()
    {
        return view('livewire.admin.attribute.edit-product-attribute-component')->layout('layouts.base');
    }

    // Updated Hook
    public function updated($fileds)
    {
        $this->validateOnly($fileds, [
            'name' => ['required']
        ]);
    }
    // Save Attribute
    public function update()
    {
        $this->validate([
            'name' => ['required']
        ]);

        $attribute = ProductAttribute::find($this->attribute_id);
        $attribute->name = $this->name;
        $attribute->update();
        
        session()->flash('success_message', 'Product Attribute Updated Successfully!');
    }
}
