<div class="wrap-icon-section minicart">
    <a href="#" class="link-direction">
        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
        <div class="left-info">
            @if (Cart::instance('cart')->count() > 0)
                <span class="index">4 items</span>
            @endif
            <span class="title">CART</span>
        </div>
    </a>
</div>