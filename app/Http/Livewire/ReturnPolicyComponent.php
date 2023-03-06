<?php

namespace App\Http\Livewire;

use App\Models\ReturnPolicy;
use Livewire\Component;

class ReturnPolicyComponent extends Component
{
    public function render()
    {
        $return_policy = ReturnPolicy::first();
        return view('livewire.return-policy-component', compact('return_policy'))->layout('layouts.base');
    }
}
