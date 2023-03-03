<x-guest-layout>
    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">Home</a></li>
                <li class="item-link"><span>Register</span></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">							
                <div class=" main-content-area">
                    <div class="wrap-login-item ">
                        <div class="register-form form-item ">
                            <form class="form-stl" method="POST" action="{{ route('register') }}">
                                @csrf
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">Create an account</h3>
                                    <h4 class="form-subtitle">Personal infomation</h4>
                                </fieldset>									
                                <fieldset class="wrap-input">
                                    <label for="name">Name*</label>
                                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Last name*">
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="email">Email Address*</label>
                                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"  placeholder="Email address">
                                </fieldset>
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">Login Information</h3>
                                </fieldset>
                                <fieldset class="wrap-input item-width-in-half left-item ">
                                    <label for="password">Password *</label>
                                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Password">
                                </fieldset>
                                <fieldset class="wrap-input item-width-in-half ">
                                    <label for="password_confirmation">Confirm Password *</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                                </fieldset>
                                <input type="submit" class="btn btn-sign" value="{{ __('Register') }}" name="register">
                            </form>
                        </div>											
                    </div>
                </div><!--end main products area-->		
            </div>
        </div><!--end row-->

    </div><!--end container-->
</x-guest-layout>
