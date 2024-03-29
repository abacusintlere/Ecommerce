
<div class="container">
    <style>
.wrap-address-billing .row-in-form input[type=password] {
    font-size: 13px;
    line-height: 19px;
    display: inline-block;
    height: 43px;
    padding: 2px 20px;
    width: 100%;
    border: 1px solid #e6e6e6;
}
    </style>
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">Home</a></li>
            <li class="item-link"><span>Checkout</span></li>
        </ul>
    </div>
    <div class=" main-content-area">
        <form action="#" wire:submit.prevent='placeOrder' onsubmit="$('#placeOrder').show();">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrap-address-billing">
                        <h3 class="box-title">Billing Address</h3>
                        <div class="billing-address">
                            <p class="row-in-form">
                                <label for="fname">first name<span>*</span></label>
                                <input id="fname" type="text" name="fname" value="" placeholder="Your name" wire:model='firstname'>
                                @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="lname">last name<span>*</span></label>
                                <input id="lname" type="text" name="lname" value="" placeholder="Your last name" wire:model='lastname'>
                                @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror

                            </p>
                            <p class="row-in-form">
                                <label for="email">Email Addreess:</label>
                                <input id="email" type="email" name="email" value="" placeholder="Type your email" wire:model='email'>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                            </p>
                            <p class="row-in-form">
                                <label for="phone">Phone number<span>*</span></label>
                                <input id="phone" type="number" name="phone" value="" placeholder="10 digits format" wire:model='mobile'>
                                @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror

                            </p>
                            <p class="row-in-form">
                                <label for="line1">Line1:</label>
                                <input id="line1" type="text" name="add" value="" placeholder="Street at apartment number" wire:model='line1'>
                                @error('line1') <span class="text-danger">{{ $message }}</span> @enderror

                            </p>
                            <p class="row-in-form">
                                <label for="line2">Line2:</label>
                                <input id="line2" type="text" name="add" value="" placeholder="Street at apartment number" wire:model='line2'>
                                @error('line2') <span class="text-danger">{{ $message }}</span> @enderror

                            </p>
                            <p class="row-in-form">
                                <label for="country">Country<span>*</span></label>
                                <input id="country" type="text" name="country" value="" placeholder="United States" wire:model="country">
                                @error('country') <span class="text-danger">{{ $message }}</span> @enderror

                            </p>

                            <p class="row-in-form">
                                <label for="city">Town / City<span>*</span></label>
                                <input id="city" type="text" name="city" value="" placeholder="City name" wire:model="city">
                                @error('city') <span class="text-danger">{{ $message }}</span> @enderror

                            </p>
                            <p class="row-in-form">
                                <label for="zip-code">Postcode / ZIP:</label>
                                <input id="zip-code" type="number" name="zip-code" value="" placeholder="Your postal code" wire:model="zipcode">
                                @error('zipcode') <span class="text-danger">{{ $message }}</span> @enderror

                            </p>
                            <p class="row-in-form fill-wife">
                                <label class="checkbox-field">
                                    <input name="different-add" id="different-add" value="1" type="checkbox" wire:model='ship_to_different'>
                                    <span>Ship to a different address?</span>
                                </label>
                            </p>
                        </div>
                    </div>
                    @if($ship_to_different)
                        <div class="wrap-address-billing">
                            <h3 class="box-title">Shipping Address</h3>
                            <div class="billing-address">
                                <p class="row-in-form">
                                    <label for="fname">first name<span>*</span></label>
                                    <input id="fname" type="text" name="fname" value="" placeholder="Your name" wire:model="s_firstname">
                                    @error('s_firstname') <span class="text-danger">{{ $message }}</span> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="lname">last name<span>*</span></label>
                                    <input id="lname" type="text" name="lname" value="" placeholder="Your last name" wire:model="s_lastname">
                                    @error('s_lastname') <span class="text-danger">{{ $message }}</span> @enderror

                                </p>
                                <p class="row-in-form">
                                    <label for="email">Email Addreess:</label>
                                    <input id="email" type="email" name="email" value="" placeholder="Type your email" wire:model="s_email">
                                    @error('s_email') <span class="text-danger">{{ $message }}</span> @enderror

                                </p>
                                <p class="row-in-form">
                                    <label for="phone">Phone number<span>*</span></label>
                                    <input id="phone" type="number" name="phone" value="" placeholder="10 digits format" wire:model="s_mobile">
                                    @error('s_mobile') <span class="text-danger">{{ $message }}</span> @enderror

                                </p>
                                <p class="row-in-form">
                                    <label for="line1">Line1:</label>
                                    <input id="line1" type="text" name="add" value="" placeholder="Street at apartment number" wire:model='s_line1'>
                                    @error('s_line1') <span class="text-danger">{{ $message }}</span> @enderror

                                </p>
                                <p class="row-in-form">
                                    <label for="line2">Line2:</label>
                                    <input id="line2" type="text" name="add" value="" placeholder="Street at apartment number" wire:model='s_line2'>

                                </p>
                                <p class="row-in-form">
                                    <label for="country">Country<span>*</span></label>
                                    <input id="country" type="text" name="country" value="" placeholder="United States" wire:model="s_country">
                                    @error('s_country') <span class="text-danger">{{ $message }}</span> @enderror

                                </p>

                                <p class="row-in-form">
                                    <label for="province">Province<span>*</span></label>
                                    <input id="province" type="text" name="province" value="" placeholder="Province" wire:model="s_province">
                                    @error('s_province') <span class="text-danger">{{ $message }}</span> @enderror

                                </p>

                                <p class="row-in-form">
                                    <label for="city">Town / City<span>*</span></label>
                                    <input id="city" type="text" name="city" value="" placeholder="City name"  wire:model="s_city">
                                    @error('s_city') <span class="text-danger">{{ $message }}</span> @enderror

                                </p>
                                <p class="row-in-form">
                                    <label for="zip-code">Postcode / ZIP:</label>
                                    <input id="zip-code" type="number" name="zip-code" value="" placeholder="Your postal code"  wire:model="s_zipcode">
                                    @error('s_zipcode') <span class="text-danger">{{ $message }}</span> @enderror

                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="summary summary-checkout">
                <div class="summary-item payment-method">
                    <h4 class="title-box">Payment Method</h4>
                    @if($paymentmode == "card")
                        <div class="wrap-address-billing">
                            @if (Session::has('stripe_error'))
                                <div class="alert alert-danger" role="alert">{{ Session::get('stripe_error') }}</div>
                            @endif
                            <p class="row-in-form">
                                <label for="card_number">Card Number:</label>
                                <input id="card_number" type="number" name="card_number" value="" placeholder="Your Card Number" wire:model="card_number">
                                @error('card_number') <span class="text-danger">{{ $message }}</span> @enderror

                            </p>

                            <p class="row-in-form">
                                <label for="expiry_month">Expiry Month:</label>
                                <input id="expiry_month" type="number" name="expiry_month" value="" placeholder="MM" wire:model="expiry_month">
                                @error('expiry_month') <span class="text-danger">{{ $message }}</span> @enderror

                            </p>

                            <p class="row-in-form">
                                <label for="expiry_year">Expiry Year:</label>
                                <input id="expiry_year" type="number" name="expiry_year" value="" placeholder="YYYY" wire:model="expiry_year">
                                @error('expiry_year') <span class="text-danger">{{ $message }}</span> @enderror

                            </p>

                            <p class="row-in-form">
                                <label for="csv">CSV:</label>
                                <input id="csv" type="password" name="csv" value="" placeholder="CSV" wire:model="csv">
                                @error('csv') <span class="text-danger">{{ $message }}</span> @enderror

                            </p>
                        </div>
                    @endif
                    <div class="choose-payment-methods">
                        <label class="payment-method">
                            <input name="payment-method" id="payment-method-bank" value="cod" type="radio" wire:model="paymentmode">
                            <span>Cash On Delivery</span>
                            <span class="payment-desc">Order Now But Pay on Delivery</span>
                        </label>
                        <label class="payment-method">
                            <input name="payment-method" id="payment-method-visa" value="card" type="radio" wire:model="paymentmode">
                            <span>Debit / Credit Card</span>
                            <span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
                        </label>
                        <label class="payment-method">
                            <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio" wire:model="paymentmode">
                            <span>Paypal</span>
                            <span class="payment-desc">You can pay with your credit</span>
                            <span class="payment-desc">card if you don't have a paypal account</span>
                        </label>
                        @error('paymentmode') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    @if(Session::has('checkout'))
                        <p class="summary-info grand-total"><span>Grand Total</span> <span
                            class="grand-total-price">${{ Session::get('checkout')['total'] }}</span></p>
                    @endif

                    @if($errors->isEmpty())
                        <div wire:ignore id="processing" style="font-size:12px; margin-bottom:20px; padding-left:37px; color:green; display:none;">
                            <i class="fa fa-spinner fa-pulse fa-fw"></i>
                            <span>Processing...</span>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-medium">Place order now</button>
                </div>
                <div class="summary-item shipping-method">
                    <h4 class="title-box f-title">Shipping method</h4>
                    <p class="summary-info"><span class="title">Flat Rate</span></p>
                    <p class="summary-info"><span class="title">Fixed $0</span></p>
                </div>
            </div>
        </form>
    </div>
    <!--end main content area-->
</div>
<!--end container-->