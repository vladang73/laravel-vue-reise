<?php

/**
 * ##########
 * ### Auth routes
 * ##########
 */
Route::get('auth/logout', 'AuthController@logout')->name('logout');
Route::get('auth/getToken', 'AuthController@getToken');

Route::group(['middleware' => ['web', 'guest']], function () {
    Route::get('auth/login', 'AuthController@showLogin');
    Route::post('auth/login', 'AuthController@login')->name('login');
    Route::get('auth/forgot', 'AuthController@showForgot')->name('forgot_password');
    Route::post('auth/forgot', 'AuthController@forgot')->name('forgot');
    Route::get('auth/recovery/{hash}', 'AuthController@recovery')->where(['hash' => '[a-zA-Z0-9]{16}'])->name('recovery');
    Route::post('auth/change-pass/{hash}', 'AuthController@changePass')->where(['hash' => '[a-zA-Z0-9]{16}'])->name('change-pass');
});

Route::get('privacy-policy/{provider}/{id}/{email}', 'PolicyController@privacy')
    ->where([
        'id' => '\d{0,11}',
        'email' => '^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$',
        'provider' => 'preisdaler|reisbureau'
    ])
    ->name('policy');
Route::post('privacy-policy/save', 'PolicyController@save');

Route::get('resize/{template}/{width}x{height}/{path}', 'ImageController@getCachedImage')->where(['path' => '([^.].*)']);

Route::get('/', 'HomeController@index')->name('home');
Route::get('test', 'TestController@index');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/{vue?}', 'AdminController@index')->where('vue', '[\/\w\.-]*')->name('admin.index');
});
