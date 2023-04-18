<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserProfileComponent extends Component
{
    public function render()
    {
        $user = User::find(Auth::user()->id);
        return view('livewire.user.user-profile-component', compact('user'))->layout('layouts.base');
    }
}
