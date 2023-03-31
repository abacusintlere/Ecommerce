<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordComponent extends Component
{
    public $current_password, $password, $password_confirmation;
    public function render()
    {
        return view('livewire.user.change-password-component')->layout('layouts.base');
    }

    // Updated Hook
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed|different:current_password',
        ]);
    }
    // Function for Password Change
    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed|different:current_password',
        ]);

        if(Hash::check($this->current_password, Auth::user()->password))
        {
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($this->password);
            $user->update();
            session()->flash('password_success', 'Password Changed Successfully!');

        }
        else{
            session()->flash('password_error', 'Password Does Not Match');
        }
    }
}
