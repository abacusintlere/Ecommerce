<x-guest-layout>
    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>login</span></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                <div class=" main-content-area">
                    <div class="wrap-login-item ">						
                        <div class="login-form form-item form-stl">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                    
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">Log in to your account</h3>										
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="email">Email Address:</label>
                                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"  placeholder="Type your email address">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="password">Password:</label>
                                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="************">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                
                                <fieldset class="wrap-input">
                                    <label class="remember-field">
                                        <input class="frm-input " id="remember_me" name="remember" value="forever" type="checkbox"><span>{{ __('Remember me') }}</span>
                                    </label>
                                    @if (Route::has('password.request'))
                                        <a class="link-function left-position" href="{{ route('password.request') }}" title="Forgotten password?">{{ __('Forgot your password?') }}</a>
                                    @endif
                                </fieldset>
                                <input type="submit" class="btn btn-submit" value="{{ __('Log in') }}" name="submit">
                            </form>
                        </div>												
                    </div>
                </div><!--end main products area-->		
            </div>
        </div><!--end row-->

    </div><!--end container-->
</x-guest-layout>
