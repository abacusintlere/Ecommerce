<?php

use App\Models\ProductAttribute;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\AboutUsComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ThankYouComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Livewire\ContactUsComponent;
use App\Http\Livewire\User\ReviewComponent;
use App\Http\Livewire\ReturnPolicyComponent;
use App\Http\Livewire\PrivacyPolicyComponent;
use App\Http\Livewire\User\UserOrderComponent;
use App\Http\Livewire\Admin\Sale\SaleComponent;
use App\Http\Livewire\TermsConditionsComponent;
use App\Http\Livewire\User\UserProfileComponent;
use App\Http\Livewire\Admin\Orders\OrderComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\User\ChangePasswordComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\Coupons\CouponComponent;
use App\Http\Livewire\User\UserEditProfileComponent;
use App\Http\Livewire\Admin\Coupons\AddCouponComponent;
use App\Http\Livewire\Admin\Coupons\EditCouponComponent;
use App\Http\Livewire\Admin\Orders\OrderDetailsComponent;
use App\Http\Livewire\Admin\Product\AdminProductComponent;
use App\Http\Livewire\Admin\Category\AdminCategoryComponent;
use App\Http\Livewire\Admin\Product\AdminAddProductComponent;
use App\Http\Livewire\Admin\Product\AdminEditProductComponent;
use App\Http\Livewire\Admin\Category\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\HomeCategory\HomeCategoryComponent;
use App\Http\Livewire\Admin\Attribute\ProductAttributeComponent;
use App\Http\Livewire\Admin\Category\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\HomeSlider\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\HomeCategory\AddHomeCategoryComponent;
use App\Http\Livewire\Admin\Attribute\AddProductAttributeComponent;
use App\Http\Livewire\Admin\HomeCategory\EditHomeCategoryComponent;
use App\Http\Livewire\Admin\HomeSlider\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\Attribute\EditProductAttributeComponent;
use App\Http\Livewire\Admin\HomeSlider\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\ContactUsComponent as AdminContactUsComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home Component
Route::get('/', HomeComponent::class)->name('home');
// Shop Component
Route::get('shop', ShopComponent::class)->name('shop');
// Product Details
Route::get('product/details/{slug}', DetailsComponent::class)->name('product.details');
// For Getting Products of a Particular Category
Route::get('products-category/{category_slug}/{subcategory_slug?}', CategoryComponent::class)->name('products.category');
// For Searching Product 
Route::get('product/search', SearchComponent::class)->name('product.search');
// Cart Component
Route::get('cart', CartComponent::class)->name('cart');
// Wishlist Component
Route::get('wishlist', WishlistComponent::class)->name('wishlist');
// Check Out Component
Route::get('checkout', CheckoutComponent::class)->name('checkout');
// Thank You Route Component
Route::get('/thank-you', ThankYouComponent::class)->name('thank.you');
// About Us Component
Route::get('about-us', AboutUsComponent::class)->name('about.us');
// Contact Us Component
Route::get('contact-us', ContactUsComponent::class)->name('contact.us');
// Terms & Conditions Component
Route::get('terms-conditions', TermsConditionsComponent::class)->name('terms.conditions');
// Return Policy Component
Route::get('return-policy', ReturnPolicyComponent::class)->name('return.policy');
// Privacy and Policy Component
Route::get('privacy-policy', PrivacyPolicyComponent::class)->name('privacy.policy');
// Move Product From Wishlist To Cart



// Authentication Routes For User
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:User'
])->group(function () {
    // User Dashboard
    Route::get('user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
    ################################## User Orders ########################################
    Route::get('user/orders', UserOrderComponent::class)->name('user.orders');
    Route::get('user/orders/{order_id}', OrderDetailsComponent::class)->name('user.order.details');
    Route::get('user/review/{order_item_id}', ReviewComponent::class)->name('user.review');

    ################################## User Change Password ########################################
    Route::get('user/password/change', ChangePasswordComponent::class)->name('user.password.change');
    
    ################################## User Profile ########################################
    Route::get('user/profile', UserProfileComponent::class)->name('user.profile');

    ################################## User Edit Profile ########################################
    Route::get('user/edit/profile', UserEditProfileComponent::class)->name('user.edit.profile');

});

// Authentication Routes For Admin
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:Admin'
])->group(function () {
    // Admin Dashboard
    Route::get('admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    ################################## Category ########################################
    // Admin Categories
    Route::get('admin/categories', AdminCategoryComponent::class)->name('admin.categories');
    // For Category Addition
    Route::get('admin/category/add', AdminAddCategoryComponent::class)->name('admin.add.category');
    // For Editing Category
    Route::get('admin/category/edit/{category_slug}', AdminEditCategoryComponent::class)->name('admin.edit.category');

    ################################## Product ########################################
    Route::get('admin/products', AdminProductComponent::class)->name('admin.products');
    // For Category Addition
    Route::get('admin/product/add', AdminAddProductComponent::class)->name('admin.add.product');
    // For Editing Category
    Route::get('admin/product/edit/{product_slug}', AdminEditProductComponent::class)->name('admin.edit.product');

    ################################## Home Page Slider ########################################
    Route::get('admin/sliders', AdminHomeSliderComponent::class)->name('admin.sliders');
    // For Category Addition
    Route::get('admin/slider/add', AdminAddHomeSliderComponent::class)->name('admin.add.slider');
    // For Editing Category
    Route::get('admin/slider/edit/{slider_id}', AdminEditHomeSliderComponent::class)->name('admin.edit.slider');


    ################################## Home Page Categories ########################################
    Route::get('admin/home/categories', HomeCategoryComponent::class)->name('admin.home.categories');

    ################################## Sale Settings ###############################################
    Route::get('admin/sale/settings', SaleComponent::class)->name('admin.sale.settings');

    ################################## Coupons ########################################
    Route::get('admin/coupons', CouponComponent::class)->name('admin.coupons');
    // For Category Addition
    Route::get('admin/coupon/add', AddCouponComponent::class)->name('admin.add.coupon');
    // For Editing Category
    Route::get('admin/coupon/edit/{coupon_id}', EditCouponComponent::class)->name('admin.edit.coupon');

    ################################## Orders ########################################
    Route::get('admin/orders', OrderComponent::class)->name('admin.orders');
    Route::get('admin/orders/{order_id}', OrderDetailsComponent::class)->name('admin.order.details');

    ################################## Contact Us Message ########################################
    Route::get('admin/contact/messages', AdminContactUsComponent::class)->name('admin.contact.messages');

    ################################## Coupons ########################################
    Route::get('admin/attributes', ProductAttributeComponent::class)->name('admin.attributes');
    // For Category Addition
    Route::get('admin/attributes/add', AddProductAttributeComponent::class)->name('admin.add.attribute');
    // For Editing Category
    Route::get('admin/attributes/edit/{attribute_id}', EditProductAttributeComponent::class)->name('admin.edit.attribute');
});
