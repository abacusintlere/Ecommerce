<?php

namespace App\Http\Livewire;

use App\Models\PrivacyPolicy;
use Livewire\Component;

class PrivacyPolicyComponent extends Component
{
    public function render()
    {
        $privacy_policy = PrivacyPolicy::first();
        return view('livewire.privacy-policy-component', compact('privacy_policy'))->layout('layouts.base');
    }
}
