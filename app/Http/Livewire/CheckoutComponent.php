<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;

class CheckoutComponent extends Component
{
    // For Checkout Forms
    public $ship_to_different, $firstname, $lastname, $email, $mobile, $line1, $line2, $city, $province, $country, $zipcode, $s_firstname, $s_lastname, $s_email, $s_mobile, $s_line1, $s_line2, $s_city, $s_province, $s_country, $s_zipcode, $paymentmode, $thankyou;

    // For Stripe Card
    public $card_number, $expiry_month, $expiry_year, $csv;

    public function render()
    {
        $this->verifyForCheckout();
        return view('livewire.checkout-component')->layout('layouts.base');
    }

    // Hook For Live Validation
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'line1' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
            'paymentmode' => 'required',
        ]);

        // Validate Shipping Fields Only If Shipping Address is Different from Billing
        if($this->ship_to_different)
        {
            $this->validateOnly($fields, [
                's_firstname' => 'required',
                's_lastname' => 'required',
                's_email' => 'required|email',
                's_mobile' => 'required|numeric',
                's_line1' => 'required',
                's_city' => 'required',
                's_province' => 'required',
                's_country' => 'required',
                's_zipcode' => 'required',
            ]);
        }

        // Validating Stripe Card Fields
        if($this->paymentmode == "card")
        {
            $this->validateOnly($fields, [
                'card_number' => 'required|numeric',
                'expiry_month' => 'required|numeric',
                'expiry_year' => 'required|numeric',
                'csv' => 'required|numeric',
            ]);
        }
    }

    // For Placing Order
    public function placeOrder()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'line1' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
            'paymentmode' => 'required',
        ]);

        // Validating Stripe Card Fields
        if($this->paymentmode == "card")
        {
            $this->validate([
                'card_number' => 'required|numeric',
                'expiry_month' => 'required|numeric',
                'expiry_year' => 'required|numeric',
                'csv' => 'required|numeric',
            ]);
        }

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->subtotal = session()->get('checkout')['subtotal'];
        $order->discount = session()->get('checkout')['discount'];
        $order->tax = session()->get('checkout')['tax'];        
        $order->total = session()->get('checkout')['total'];
        $order->firstname = $this->firstname;
        $order->lastname = $this->lastname;
        $order->mobile = $this->mobile;
        $order->email = $this->email;
        $order->line1 = $this->line1;
        $order->line2 = $this->line2;
        $order->city = $this->city;
        $order->province = $this->province;
        $order->country = $this->country;
        $order->zipcode = $this->zipcode;
        $order->status = 'ordered';
        $order->is_shipping_different = $this->ship_to_different ? 1 : 0;
        $order->save();

        // Saving Order Items
        foreach(Cart::instance('cart')->content() as $item)
        {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->save();

        }

        if($this->is_shipping_different)
        {
            $this->validate([
                's_firstname' => 'required',
                's_lastname' => 'required',
                's_email' => 'required|email',
                's_mobile' => 'required|numeric',
                's_line1' => 'required',
                's_city' => 'required',
                's_province' => 'required',
                's_country' => 'required',
                's_zipcode' => 'required',
            ]);

            $shipping = new Shipping();
            $shipping->order_id = $order->id;
            $shipping->firstname = $this->s_firstname;
            $shipping->lastname = $this->s_lastname;
            $shipping->mobile = $this->s_mobile;
            $shipping->email = $this->s_email;
            $shipping->line1 = $this->s_line1;
            $shipping->line2 = $this->s_line2;
            $shipping->city = $this->s_city;
            $shipping->province = $this->s_province;
            $shipping->country = $this->s_country;
            $shipping->zipcode = $this->s_zipcode;
            $shipping->save();
        }

        if($this->paymentmode == "cod")
        {
            $this->makeTransaction($order->id, "pending");
            $this->resetCart();

        }
        elseif($this->paymentmode == "card")
        {
            // $this->makeTransaction($order->id, "pending");
            $stripe = Stripe::make(env("STRIPE_KEY"));

            try{
                $token = $stripe->tokens()->create([
                    "card" => [
                        "number" => $this->card_number,
                        "exp_month" => $this->expiry_month,
                        "exp_year" => $this->expiry_year,
                        "csv" => $this->csv
                    ]
                ]);

                if(!isset($token["id"]))
                {
                    session()->flash('stripe_error', 'The Stripe Token was Not Generated Successfully!');
                    $this->thankyou=0;
                }

                // making Customer
                $customer = $stripe->customers()->create([
                    'name' => $this->firstname . " " . $this->lastname,
                    'email' => $this->email,
                    'phone' => $this->mobile,
                    'address' => [
                        'line1' => $this->line1,
                        'postal_code' => $this->zipcode,
                        'city' => $this->city,
                        'state' => $this->province,
                        'country' => $this->country
                    ],
                    'shipping' => [
                        'line1' => $this->line1,
                        'postal_code' => $this->zipcode,
                        'city' => $this->city,
                        'state' => $this->province,
                        'country' => $this->country
                    ],
                    'source' => $token["id"]
                ]);

                // Making Charge
                $charge = $stripe->charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'USD',
                    'amount' => session()->get('checkout')['total'],
                    'description' => 'Payment for Order No ' . $order->id
                ]);

                if($charge['status'] == 'succeeded')
                {
                    $this->makeTransaction($order->id, "approved");
                    $this->resetCart();
        
                }
                else
                {
                    session()->flash('stripe_error','Error In Transaction');
                    $this->thankyou = 0;
                }
            }catch(Exception $e)
            {
                session()->flash('stripe_error', $e->getMessage());
                $this->thankyou = 0;
            }

        }

        // Setting Thank You Variable to 1
        $this->thankyou=1;
        // Now Finally Destroying Cart
        Cart::instance('cart')->destroy();
        session()->forget('checkout');
    }

    // For Making Transaction
    public function makeTransaction($order_id, $status)
    {
        $transaction  = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $order_id;
        $transaction->mode = $this->paymentmode;
        $transaction->status = $status;
        $transaction->save();
    }

    // For Verification of Checkout
    public function verifyForCheckout()
    {
        if(!Auth::check())
        {
            return redirect()->route('login');
        }
        elseif($this->thankyou)
        {
            return redirect()->route('thank.you');
        }
        elseif(!session()->get('checkout'))
        {
            return redirect()->route('cart');
        }
    }

    // For Reseting Cart
    public function resetCart()
    {
        $this->thankyou=1;
        Cart::instance('cart')->destroy();
        session()->forget('checkout');
    }
}
