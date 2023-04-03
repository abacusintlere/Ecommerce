<?php

namespace App\Http\Livewire;

use App\Models\WebSetting;
use Livewire\Component;

class FooterComponent extends Component
{
    public function render()
    {
        $settings = WebSetting::find(1);
        return view('livewire.footer-component', compact('settings'));
    }
}
