<?php

namespace App\Http\Livewire;

use App\Models\AboutUs;
use Livewire\Component;

class AboutUsComponent extends Component
{
    public function render()
    {
        $about_us = AboutUs::first();
        return view('livewire.about-us-component', compact('about_us'))->layout('layouts.base');
    }
}
