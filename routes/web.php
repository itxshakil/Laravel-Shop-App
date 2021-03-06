<?php

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::get('/product/view/{slug}', 'ProductController@view')->name('product.view');
Route::get('/checkout', 'OrderController@store')->name('order.create');
Route::get('/checkout/{order}', 'OrderController@checkout')->name('order.checkout');
Route::post('/payment', 'PaymentController@store')->name('payment.verify');
Route::get('/payment/{payment}', 'PaymentController@show')->name('payment.status');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/{product}', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/switchToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::delete('/saveForLater/{product}', 'saveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/switchToSaveToCart/{product}', 'saveForLaterController@switchToSaveToCart')->name('saveForLater.switchToCart');

// Admin
Route::group(['prefix' => 'admin'], function () {
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    // Pasword Reset Routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    Route::middleware(['auth:admin'])->group(function () {
        Route::resource('/products', 'Admin\ProductController');
        Route::resource('/orders', 'Admin\OrderController');
        Route::resource('/payments', 'Admin\PaymentController');
    });
});
