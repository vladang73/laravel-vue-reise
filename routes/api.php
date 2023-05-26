<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {

    Route::group([
        'namespace' => 'Admin',
        'prefix' => 'admin',
        'middleware' => ['api.auth']
    ], function () {
        Route::resource('users', 'UsersController');
        Route::resource('holiday-types', 'HolidayTypeController');
        Route::resource('travel-agencies', 'TravelAgencyController');
        Route::resource('booking', 'BookingController');
        Route::resource('scheduling', 'SchedulingController');
        Route::get('reservation', 'BookingController@store');
        Route::post('upload-avatar', 'FileUploadController@uploadAvatar');
        Route::get('texts', 'PrivacyController@index');
        Route::post('texts/update/{id}', 'PrivacyController@update')/*->where(['id' => '/^[0-9]+/'])*/;
        Route::get('handbook/get-colors', 'HandbookController@getColors');
        Route::get('handbook/get-cities', 'HandbookController@getCities');
        Route::get('handbook/get-providers', 'HandbookController@getProviders');
        Route::get('handbook/get-genders', 'HandbookController@getGenders');
        Route::get('handbook/get-locations', 'HandbookController@getLocations');
    });
});