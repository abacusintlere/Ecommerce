<div class="container">

    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">Home</a></li>
            <li class="item-link"><span>Product Categories</span></li>
            <li class="item-link"><span>{{ $category->name }}</span></li>
        </ul>
    </div>
    <div class="row">

        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

            <div class="banner-shop">
                <a href="#" class="banner-link">
                    <figure><img src="{{ asset('assets/images/shop-banner.jpg') }}" alt=""></figure>
                </a>
            </div>

            <div class="wrap-shop-control">

                <h1 class="shop-title">Digital & Electronics</h1>

                <div class="wrap-right">

                    <div class="sort-item orderby ">
                        <select name="orderby" class="use-chosen" wire:model="sorting">
                            <option value="default" selected="selected">Default Sorting</option>
                            <option value="date">Sort by Date</option>
                            <option value="price">Sort by Price: Low to High</option>
                            <option value="price-desc">Sort By Price: High to Low</option>
                        </select>
                    </div>

                    <div class="sort-item product-per-page">
                        <select name="post-per-page" class="use-chosen" wire:model="pagesize">
                            <option value="12" selected="selected">12 per page</option>
                            <option value="16">16 per page</option>
                            <option value="18">18 per page</option>
                            <option value="21">21 per page</option>
                            <option value="24">24 per page</option>
                            <option value="30">30 per page</option>
                            <option value="32">32 per page</option>
                        </select>
                    </div>

                    <div class="change-display-mode">
                        <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                        <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                    </div>

                </div>

            </div><!--end wrap shop control-->

            <div class="row">

                <ul class="product-list grid-products equal-container">
                    @foreach ($products as $product)
                        <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                            <div class="product product-style-3 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{ asset('assets/images/products') }}/{{ $product->thumbnail }}" alt="{{ $product->name }}"></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>{{ $product->name }}</span></a>
                                    <div class="wrap-price"><span class="product-price">{{ $product->regular_price }}</span></div>
                                    <a href="#"class="btn add-to-cart" wire:click.prevent="addToCart('{{ $product->id}}', '{{ $product->name }}', '{{ $product->regular_price }}')">Add To Cart</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>

            <div class="wrap-pagination-info">
                {{ $products->links() }}
                {{-- <ul class="page-numbers">
                    <li><span class="page-number-item current" >1</span></li>
                    <li><a class="page-number-item" href="#" >2</a></li>
                    <li><a class="page-number-item" href="#" >3</a></li>
                    <li><a class="page-number-item next-link" href="#" >Next</a></li>
                </ul>
                <p class="result-count">Showing 1-8 of 12 result</p> --}}
            </div>
        </div><!--end main products area-->

        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
            <div class="widget mercado-widget categories-widget">
                <h2 class="widget-title">All Categories</h2>
                <div class="widget-content">
                    <ul class="list-category">
                        @foreach ($categories as $category)
                        <li class="category-item has-child-cate">
                            <a href="{{ route('products.category', ['category_slug' => $category->slug]) }}" class="cate-link">{{ Str::title($category->name) }} </a>
                            @if ($category->sub_categories->count()  >0)
                                <span class="toggle-control">+</span>
                                <ul class="sub-cate">
                                    @foreach ($category->sub_categories as $sub_category)
                                        <li class="category-item"><a href="{{ route('products.category', ['category_slug' => $category->slug, 'subcategory_slug' => $sub_category->slug], ) }}" class="cate-link">{{ Str::title($sub_category->name) }} ({{ $sub_category->sub_category_products->count() }})</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        @endforeach

                        {{-- <li class="category-item">
                            <a href="#" class="cate-link">Tools & Equipments</a>
                        </li> --}}
                    </ul>
                </div>
            </div><!-- Categories widget-->

            <div class="widget mercado-widget filter-widget brand-widget">
                <h2 class="widget-title">Brand</h2>
                <div class="widget-content">
                    <ul class="list-style vertical-list list-limited" data-show="6">
                        <li class="list-item"><a class="filter-link active" href="#">Fashion Clothings</a></li>
                        <li class="list-item"><a class="filter-link " href="#">Laptop Batteries</a></li>
                        <li class="list-item"><a class="filter-link " href="#">Printer & Ink</a></li>
                        <li class="list-item"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
                        <li class="list-item"><a class="filter-link " href="#">Sound & Speaker</a></li>
                        <li class="list-item"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li>
                        <li class="list-item default-hiden"><a class="filter-link " href="#">Printer & Ink</a></li>
                        <li class="list-item default-hiden"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
                        <li class="list-item default-hiden"><a class="filter-link " href="#">Sound & Speaker</a></li>
                        <li class="list-item default-hiden"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li>
                        <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div><!-- brand widget-->

            <div class="widget mercado-widget filter-widget price-filter">
                <h2 class="widget-title">Price: <span class="text-info">${{ $min_price }} - ${{ $max_price }}</span></h2>
                <div class="widget-content">
                    <div id="slider" wire:ignore></div>
                </div>
            </div><!-- Price-->

            <div class="widget mercado-widget filter-widget">
                <h2 class="widget-title">Color</h2>
                <div class="widget-content">
                    <ul class="list-style vertical-list has-count-index">
                        <li class="list-item"><a class="filter-link " href="#">Red <span>(217)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Yellow <span>(179)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Black <span>(79)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Blue <span>(283)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Grey <span>(116)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Pink <span>(29)</span></a></li>
                    </ul>
                </div>
            </div><!-- Color -->

            <div class="widget mercado-widget filter-widget">
                <h2 class="widget-title">Size</h2>
                <div class="widget-content">
                    <ul class="list-style inline-round ">
                        <li class="list-item"><a class="filter-link active" href="#">s</a></li>
                        <li class="list-item"><a class="filter-link " href="#">M</a></li>
                        <li class="list-item"><a class="filter-link " href="#">l</a></li>
                        <li class="list-item"><a class="filter-link " href="#">xl</a></li>
                    </ul>
                    <div class="widget-banner">
                        <figure><img src="{{ asset('assets/images/size-banner-widget.jpg') }}" width="270" height="331" alt=""></figure>
                    </div>
                </div>
            </div><!-- Size -->

            <div class="widget mercado-widget widget-product">
                <h2 class="widget-title">Popular Products</h2>
                <div class="widget-content">
                    <ul class="products">
                        @foreach ($papular_products as $product)
                        <li class="product-item">
                            <div class="product product-widget-style">
                                <div class="thumbnnail">
                                    <a href="detail.html" title="{{ $product->name }}">
                                        <figure><img src="{{ asset('assets/images/products/') }} {{ $product->thumbnail }}" alt="{{ $product->name }}" alt="{{ $product->name }}"></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>{{ $product->name }}</span></a>
                                    <div class="wrap-price"><span class="product-price">{{ $product->regular_price }}</span></div>
                                </div>
                            </div>
                        </li>
                        @endforeach


                    </ul>
                </div>
            </div><!-- brand widget-->

        </div><!--end sitebar-->

    </div><!--end row-->

</div><!--end container-->

@push('scripts')
    <script>
        var slider = document.getElementById('slider');
        noUiSlider.create(slider, {
            start : [1,1000],
            connect: true,
            range:{
                'min':1,
                'max':1000
            },
            // Show a scale with the slider
            pips: {
                mode: 'steps',
                stepped: true,
                density: 4
            }
        });
        slider.noUiSlider.on('update', function(value){
            // console.log(value[0]);
            @this.set("min_price", value[0]);
            @this.set("max_price", value[1]);
        });
    </script>
@endpush