<?php

namespace App\Http\Livewire\User;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class UserEditProfileComponent extends Component
{
    public $name;
    public $email;
    public $mobile;
    public $line1;
    public $line2;
    public $city;
    public $province;
    public $country;
    public $zipcode;
    public $image;
    public $newimage;

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        $this->name = $user->name;
        $this->email= $user->email;
        $this->mobile = $user->profile->mobile;
        $this->line1 = $user->profile->line1;
        $this->line2 = $user->profile->line2;
        $this->city = $user->profile->city;
        $this->province = $user->profile->province;
        $this->country = $user->profile->country;
        $this->zipcode = $user->profile->zipcode;
        $this->image = $user->profile->image;
    }

    use WithFileUploads;
    public function render()
    {
        $user = User::find(Auth::user()->id);
        return view('livewire.user.user-edit-profile-component', compact('user'))->layout('layouts.base');
    }

    // Update Profile 
    public function updateProfile()
    {
        $user = User::find(Auth::user()->id);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->update();

        // Updating Profile Picture
        if($this->newimage)
        {
            if($this->image && $this->image != "default.png"){
                unlink('assets/images/profiles/'.$this->image);
            }
            $newImage = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('profiles', $newImage);
            $user->profile->image = $newImage;
        }
        $user->profile->mobile = $this->mobile;
        $user->profile->line1 = $this->line1;
        $user->profile->line2 = $this->line2;
        $user->profile->city = $this->city;
        $user->profile->province = $this->province;
        $user->profile->country = $this->country;
        $user->profile->zipcode = $this->zipcode;
        $user->profile->update();

        session()->flash('success', 'Profile Updated Successfully!');

    }
}
