<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;

class CategoryComponent extends Component
{
    use WithPagination;

    public $sorting, $pagesize, $min_price, $max_price, $category_slug, $subcategory_slug;

    // Mount Function
    public function mount($category_slug, $subcategory_slug=null)
    {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->min_price = 1;
        $this->max_price = 1000;
        $this->category_slug = $category_slug;
        if($this->subcategory_slug)
        {
            $this->subcategory_slug = $subcategory_slug;
        }
        // dd($this->subcategory_slug);
    } 

    public function render()
    {
        $category = Category::where('slug', $this->category_slug)->orWhere('slug', $this->subcategory_slug)->first();
        $category_id = $category->id;
        // dd($category_id);
        if($this->sorting == "date")
        {
            $products = Product::whereBetween('regular_price',[$this->min_price, $this->max_price])->where('category_id', $category_id)->orWhere('subcategory_id', $category_id)->whereDate('created_at', 'DESC')->where('is_active', 1)->paginate($this->pagesize);
        }
        elseif($this->sorting == "price")
        {
            $products = Product::whereBetween('regular_price',[$this->min_price, $this->max_price])->where('category_id', $category_id)->orWhere('subcategory_id', $category_id)->where('is_active', 1)->orderBy('regular_price')->paginate($this->pagesize);
 
        }
        elseif($this->sorting == "price-desc")
        {
            $products = Product::whereBetween('regular_price',[$this->min_price, $this->max_price])->where('category_id', $category_id)->orWhere('subcategory_id', $category_id)->where('is_active', 1)->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        }
        else
        {
            $products = Product::whereBetween('regular_price',[$this->min_price, $this->max_price])->where('category_id', $category_id)->orWhere('subcategory_id', $category_id)->paginate($this->pagesize);
 
        }
        $papular_products = Product::where('featured', true)->take(4)->get();
        $categories = Category::where('is_active', 1)->whereNull('parent_id')->get();
        return view('livewire.category-component', compact('products','papular_products','categories', 'category'))->layout('layouts.base');
    }

    // For Storing Product Into Cart
    public function addToCart($product_id, $product_name, $product_price)
    {
        // You can even make it a one-liner
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash("success_message", "Product Added To Cart");
        return redirect()->route('cart');
    }
}
