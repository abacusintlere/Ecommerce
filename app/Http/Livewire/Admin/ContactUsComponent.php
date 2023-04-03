<?php

namespace App\Http\Livewire\Admin;

use App\Models\ContactUs;
use Livewire\Component;

class ContactUsComponent extends Component
{
    public function render()
    {
        $contacts = ContactUs::paginate(12);
        return view('livewire.admin.contact-us-component', compact('contacts'))->layout('layouts.base');
    }

    // Function for Deleting Contact Message
    public function delete($contact_id)
    {
        ContactUs::find($contact_id)->delete();
        session()->flash('success_message', 'Contact Us Message Deleted Successfully!');
    }
}
