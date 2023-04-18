<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\AttributeValue;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\File;

class AdminEditProductComponent extends Component
{
    public $name, $slug, $short_desc, $desc, $regular_price, $sale_price, $sku, $stock_status, $featured, $quantity, $thumbnail, $category,$subcategory, $attribute, $is_active, $product_id, $newImage, $images, $newImages;

    public $inputs = [];
    public $attribute_array = [];
    public $attribute_values = [];

    // Add Attribute Value 
    public function addAttributeValue()
    {
        if(!$this->attribute_array->contains($this->attribute))
        {
            $this->inputs->push($this->attribute);
            $this->attribute_array->push($this->attribute);
        }
    }

    public function removeAttributeValue($attribute)
    {
        unset($this->inputs[$attribute]);
        unset($this->attribute_array[$attribute]);
    }

    // Mount Function
    public function mount($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_desc = $product->short_desc;
        $this->desc = $product->description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->sku = $product->sku;
        $this->stock_status = $product->stock_status;
        $this->featured = $product->featured;
        $this->quantity =  $product->quantity;
        $this->thumbnail = $product->thumbnail;
        $this->images = explode(",", $product->images);
        $this->category = $product->category_id;
        $this->subcategory = $product->subcategory_id;
        $this->is_active = $product->is_active;
        $this->inputs = $product->attributeValues->where('product_id', $product->id)->unique('product_attribute_id')->pluck('product_attribute_id');
        $this->attribute_array = $product->attributeValues->where('product_id', $product->id)->unique('product_attribute_id')->pluck('product_attribute_id');

        foreach($this->attribute_array as $a_array)
        {
            $allAttributeValues = AttributeValue::where('product_id', $product->id)->where('product_attribute_id', $a_array)->get()->pluck('attribute_value');
            $valueString = '';
            foreach($allAttributeValues as $value)
            {
                $valueString .= $value . ',';
            }

            $this->attribute_values[$a_array] = rtrim($valueString, ',');
        }
        // dd($this->category);
    } 

    // Generate Slug
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    use WithFileUploads;
    public function render()
    {
        $categories = Category::where('is_active', 1)->get();
        $subcategories = Category::where('parent_id', $this->category)->get();
        $attributes = ProductAttribute::all();

        return view('livewire.admin.product.admin-edit-product-component', compact('categories', 'subcategories', 'attributes'))->layout('layouts.base');
    }
    
    // Updated Hook
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required',
            'short_desc' => 'required',
            'desc' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'sku' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            'thumbnail' => 'required|mimes:png,jpg',
            'category' => 'required',
            'is_active' => 'required',
        ]);

        if($this->newImage)
        {
            $this->validateOnly($fields, [
                'newImage' => 'required|mimes:png,jpg',
            ]);
        }
    }

    // Updating Products
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'short_desc' => 'required',
            'desc' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'sku' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            // 'thumbnail' => 'required|mimes:png,jpg',
            'category' => 'required',
            'is_active' => 'required',
        ]);

        if($this->newImage)
        {
            $this->validate([
                'newImage' => 'required|mimes:png,jpg',
            ]);
        }
        $product = Product::find($this->product_id);
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_desc = $this->short_desc;
        $product->description = $this->desc;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->sku = $this->sku;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        if($this->newImage)
        {
            if (File::exists(public_path('products/'. $product->thumbnail))) {
                unlink("assets/images/products/" . $product->thumbnail);
            }
            $thumbnail = Carbon::now()->timestamp.'.'.$this->newImage->extension(); 
            $this->thumbnail->storeAs('products', $thumbnail);
            $product->thumbnail = $thumbnail;
        }

        if($this->newImages)
        {
            $images = explode(",", $product->images);
            foreach($images as $img)
            {
                if($img)
                {
                    unlink("assets/images/products" . $img);

                }
            }

            $imagesNames = '';
            foreach($this->newImages as $key => $image)
            {
                $imgName = Carbon::now()->timestamp. $key . '.'.$image->extension(); 
                $image->storeAs('products', $imgName);

                $imagesNames = $imagesNames . ',' . $imgName;

            }
            $product->images = $imagesNames;

        }

        $product->category_id = $this->category;
        if($this->subcategory)
        {
            $product->subcategory_id = $this->subcategory;
        }
        $product->is_active = $this->is_active;
        $product->update();

        AttributeValue::where('product_id', $product->id)->delete();

        foreach($this->attribute_values as $key => $attribute_value)
        {
            $values = explode(",", $attribute_value);

            foreach($values as $value)
            {
                $attribute = new AttributeValue();
                $attribute->product_attribute_id = $key;
                $attribute->attribute_value = $value;
                $attribute->product_id = $product->id;
                $attribute->save();
            }
        }

        session()->flash('success_message', 'Product Updated Successfully!');
    }


}
