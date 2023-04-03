<?php

namespace App\Http\Livewire\Admin;

use App\Models\WebSetting;
use Livewire\Component;

class WebSettingsComponent extends Component
{
    public $email, $phone, $phone2, $address, $map, $twitter, $facebook, $pinterest, $instagram, $youtube;
    public function render()
    {
        return view('livewire.admin.web-settings-component')->layout('layouts.base');
    }

    // Mount Hook
    public function mount()
    {
        $settings = WebSetting::find(1);
        if($settings)
        {
            $this->email = $settings->email;
            $this->phone = $settings->phone;
            $this->phone2 = $settings->phone2;
            $this->address = $settings->address;
            $this->map = $settings->map;
            $this->twitter = $settings->twitter;
            $this->facebook = $settings->facebook;
            $this->pinterest = $settings->pinterest;
            $this->instagram = $settings->instagram;
            $this->youtube = $settings->youtube;
        }

    }

    // Updated Hook

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email' => 'required',
            'phone' => 'required',
            'phone2' => 'required',
            'address' => 'required',
            'map' => 'required',
            'twitter' => 'required',
            'facebook' => 'required',
            'pinterest' => 'required',
            'instagram' => 'required',
            'youtube' => 'required'
        ]);
    }

    // Updating Website Settings
    public function updateWebSettings()
    {

        $this->validate([
            'email' => 'required',
            'phone' => 'required',
            'phone2' => 'required',
            'address' => 'required',
            'map' => 'required',
            'twitter' => 'required',
            'facebook' => 'required',
            'pinterest' => 'required',
            'instagram' => 'required',
            'youtube' => 'required'
        ]);

        $settings = WebSetting::find(1);
        if(!$settings)
        {
            $settings = new WebSetting();
            $settings->email = $this->email;
            $settings->phone = $this->phone;
            $settings->phone2 = $this->phone2;
            $settings->address = $this->address;
            $settings->map = $this->map;
            $settings->twitter = $this->twitter;
            $settings->facebook = $this->facebook;
            $settings->pinterest = $this->pinterest;
            $settings->instagram = $this->instagram;
            $settings->youtube = $this->youtube;
            $settings->save();
        }
        else{
            $settings = WebSetting::find(1);
            $settings->email = $this->email;
            $settings->phone = $this->phone;
            $settings->phone2 = $this->phone2;
            $settings->address = $this->address;
            $settings->map = $this->map;
            $settings->twitter = $this->twitter;
            $settings->facebook = $this->facebook;
            $settings->pinterest = $this->pinterest;
            $settings->instagram = $this->instagram;
            $settings->youtube = $this->youtube;
            $settings->update();
        }

        session()->flash('settings_success', 'Website Settings Successfully Updated!');
    }
}
