@push('styles')
    <style>
        .product-wish{
            position:absolute;
            top:10%;
            left:0%;
            z-index: 99;
            right: 30px;
            text-align: right;
            padding-top: 0%;
        }
        .product-wish  .fa{
            color:#cbcbcb;
            font-size: 32px;
        }
        .product-wish  .fa:hover{
            color:#ff7007;
        }
        .fill-heart{
            color:#ff7007 !important;
        }
    </style>
@endpush
<div>
    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="{{ route('home') }}" class="link">home</a></li>
                <li class="item-link"><span>Wishlist</span></li>
            </ul>
        </div>

        <div class="row">
            @if(Cart::instance('wishlist')->content()->count() >0)
                <ul class="product-list grid-products equal-container">
                    @php
                        $wishlists = Cart::instance('wishlist')->content();
                    @endphp
                    @forelse ($wishlists as $wishlist)
                        <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                            <div class="product product-style-3 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ route('product.details', $wishlist->model->slug) }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{ asset('assets/images/products') }}/{{ $wishlist->model->thumbnail }}" alt="{{ $wishlist->name }}"></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('product.details', $wishlist->model->slug) }}" class="product-name"><span>{{ $wishlist->name }}</span></a>
                                    <div class="wrap-price"><span class="product-price">{{ $wishlist->regular_price }}</span></div>
                                    <a href="{{ route('product.details', $wishlist->model->slug) }}"class="btn add-to-cart" wire:click.prevent="addToCart({{ $wishlist->model->id }}, '{{ $wishlist->name }}' , {{ $wishlist->regular_price }})">Add To Cart</a>
                                    <div class="product-wish">
                                        {{-- @if($wishlist->contains($product->id))
                                            <a href="#" wire:click.prevent="removeWishList({{ $wishlist->model->id }})"><i class="fa fa-heart fill-heart"></i></a>
                                        @else --}}
                                            <a href="#" wire:click.prevent="addToWishList({{ $wishlist->model->id}}, '{{ $wishlist->name }}', {{ $wishlist->regular_price }})"><i class="fa fa-heart"></i></a>
                                        {{-- @endif --}}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <h4>No Item In Wishlist</h4>
                    @endforelse
                </ul>
            @endif
        </div>
    </div>
</div>
