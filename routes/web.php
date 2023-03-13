<?php

use App\Http\Livewire\CartComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AboutUsComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ThankYouComponent;
use App\Http\Livewire\ContactUsComponent;
use App\Http\Livewire\ReturnPolicyComponent;
use App\Http\Livewire\PrivacyPolicyComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\TermsConditionsComponent;

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
Route::get('products-category/{category_slug}', CategoryComponent::class)->name('products.category');
// For Searching Product 
Route::get('product/search', SearchComponent::class)->name('product.search');
// Cart Component
Route::get('cart', CartComponent::class)->name('cart');
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




// Authentication Routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
