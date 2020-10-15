<?php

Route::group(['namespace' => 'Frontend'], function () {

	Route::get('/', 'FrontendController@index')->name('index');
	Route::get('/customer-dashboard', 'FrontendController@index')->name('customer_dashboard');

	// Customer login and register
	Route::get('/my-account', 'MyAccountController@index')->name('my-account');
	Route::post('/my-account/register', 'MyAccountController@accountRegister')->name('my-account-register');
	Route::get('/my-account/profile', 'MyAccountController@profile')->name('my-account-profile');
	Route::get('/my-account/profile/edit/{id}', 'MyAccountController@edit_profile')->name('my-account-profile-edit');
	Route::post('/my-account/profile/update/{id}', 'MyAccountController@update_profile')->name('my-account-profile-update');
	Route::get('/my-account/orders', 'MyAccountController@orders')->name('my-account-orders');

	Route::get('/faq', 'FrontendController@faq')->name('faq');
	Route::get('/track-order', 'FrontendController@trackOrder')->name('track-order');
	Route::post('/track-order/details', 'FrontendController@trackOrderDetails')->name('track-order-details');
	Route::get('/contact-us', 'FrontendController@contact')->name('contact-us');
	Route::get('/cart', 'CartController@index')->name('cart');

	Route::get('/checkout', 'CheckoutController@index')->name('checkout');
	Route::post('/place-order', 'CheckoutController@placeOrder')->name('place-order');

	Route::get('add-to-cart/{id}', 'CartController@addToCart')->name('add-to-cart');
	Route::get('remove-cart-item/{id}', 'CartController@removeCartItem')->name('remove-cart-item');
	Route::get('increment-cart-item/{id}/{qty}', 'CartController@increment')->name('increment-cart-item');
	Route::get('decrement-cart-item/{id}/{qty}', 'CartController@decrement')->name('decrement-cart-item');
	Route::get('update-cart-item/{id}/{qty}', 'CartController@update')->name('update-cart-item');



	Route::get('/{categorySlug}', 'ProductController@categoryBasedProduct')->name('product-list');
	Route::get('/product-details/{productSlug}', 'ProductController@productDetails')->name('product-details');
	Route::get('/categories/{slug}', 'ProductController@categories')->name('categories');

	Route::post('/search', 'FrontendController@search')->name('search.item');
});
