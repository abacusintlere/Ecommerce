<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
class AdminProductComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $products = Product::with('category')->paginate(10);
        return view('livewire.admin.product.admin-product-component', compact('products'))->layout('layouts.base');
    }

    // For Deleting Product
    public function delete($id)
    {
        $product = Product::find($id);
        if($product->thumbnail)
        {
            unlink('assets/images/products' . '/' . $product->thumbnail);
        }

        if($product->images)
        {
            $images = explode(",", $product->images);
            foreach($images as $img)
            {
                if($img)
                {
                    unlink('assets/images/products' . '/' . $img);
                }
            }
        }

        $product->delete();
        session()->flash('success_message', 'Product Deleted Successfully!');
    }
}
