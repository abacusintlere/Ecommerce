<?php

namespace App\Http\Livewire\Admin\HomeSlider;

use Livewire\Component;
use App\Models\HomeSlider;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class AdminAddHomeSliderComponent extends Component
{
    public $title, $subtitle, $price, $image, $link, $status;

    use WithFileUploads;
    public function render()
    {
        return view('livewire.admin.home-slider.admin-add-home-slider-component')->layout('layouts.base');
    }

    // Updated Hook
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'title' => 'required',
            'subtitle' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|mimes:png,jpg',
            'link' => 'required',
            'status' => 'required'
        ]);
    }

    // For Storing Slider
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|mimes:png,jpg',
            'link' => 'required',
            'status' => 'required'
        ]);

        $slider = new HomeSlider();
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link =$this->link;
        $image = Carbon::now()->timestamp.'.'.$this->image->extension(); 
        $this->image->storeAs('sliders', $image);
        $slider->image = $image;
        $slider->status = $this->status;
        $slider->save();

        session()->flash('success_message', 'Home Slider Added Successfully!');
    }
}
