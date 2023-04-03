<?php

namespace App\Http\Livewire;

use App\Models\ContactUs;
use App\Models\WebSetting;
use Livewire\Component;

class ContactUsComponent extends Component
{
    public $name, $email, $phone, $comment;

    public function render()
    {
        $settings = WebSetting::find(1);
        return view('livewire.contact-us-component', compact('settings'))->layout('layouts.base');
    }

    // Updated Hook
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'comment' => 'required'
        ]);
    }

    // Send Message 
    public function sendMessage()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'comment' => 'required'
        ]);

        $contact = new ContactUs();
        $contact->name = $this->name;
        $contact->email = $this->email;
        $contact->phone = $this->phone;
        $contact->comment = $this->comment;
        $contact->save();

        session()->flash('send_message', 'Your Message Sent Successfully!');
    }
}
