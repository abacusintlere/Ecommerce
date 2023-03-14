<?php

namespace App\Http\Livewire\Admin\HomeSlider;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithPagination;
class AdminHomeSliderComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $sliders = HomeSlider::paginate(10);
        return view('livewire.admin.home-slider.admin-home-slider-component', compact('sliders'))->layout('layouts.base');
    }
}
