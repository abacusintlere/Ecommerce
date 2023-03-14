<?php

namespace App\Http\Livewire\Admin\HomeSlider;

use Livewire\Component;
use App\Models\HomeSlider;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminEditHomeSliderComponent extends Component
{
    public $title, $subtitle, $price, $image, $link, $status, $newImage, $slider_id;

    use WithFileUploads;

    // Mount Function
    public function mount($slider_id)
    {
        $slider = HomeSlider::where('id', $slider_id)->first();
        $this->slider_id = $slider->id;
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->price = $slider->price;
        $this->link = $slider->link;
        $this->image = $slider->image;
        $this->status = $slider->status;
    }

    public function render()
    {
        return view('livewire.admin.home-slider.admin-edit-home-slider-component')->layout('layouts.base');
    }

    // Function For Updating Slider

    public function update()
    {
        $slider = HomeSlider::find($this->slider_id);
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;
        $slider->status = $this->status;
        if($this->newImage)
        {
            $sliderImage = Carbon::now()->timestamp.'.'.$this->thumbnail->extension(); 
            $this->thumbnail->storeAs('sliders', $sliderImage);
            $slider->image = $slider;
        }
        $slider->update();
        session()->flash('success_message', 'Slider Updated Successfully!');
    }
}
