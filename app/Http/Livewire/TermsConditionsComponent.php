<?php

namespace App\Http\Livewire;

use App\Models\TermCondition;
use Livewire\Component;

class TermsConditionsComponent extends Component
{
    public function render()
    {
        $terms_conditions = TermCondition::first();
        return view('livewire.terms-conditions-component',compact('terms_conditions'))->layout('layouts.base');
    }
}
