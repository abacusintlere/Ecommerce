<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
class AdminProductComponent extends Component
{
    use WithPagination;
    public $searchTerm;
    public function render()
    {
        $serach = "%" . $this->searchTerm . "%";
        $products = Product::with('category')
            ->where('name', 'LIKE', $serach)
            ->orWhere('stock_status', 'LIKE', $serach)
            ->orWhere('regular_price', 'LIKE', $serach)
            ->orWhere('sale_price', 'LIKE', $serach)
            ->orderBy('id', 'DESC')
            ->paginate(10);
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
