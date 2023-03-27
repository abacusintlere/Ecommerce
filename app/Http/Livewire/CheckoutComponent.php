<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CheckoutComponent extends Component
{
    public $ship_to_different, $firstname, $lastname, $email, $mobile, $line1, $line2, $city, $province, $country, $zipcode, $s_firstname, $s_lastname, $s_email, $s_mobile, $s_line1, $s_line2, $s_city, $s_province, $s_country, $s_zipcode;
    public function render()
    {
        return view('livewire.checkout-component')->layout('layouts.base');
    }
}
