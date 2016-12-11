<?php

// Admin web routes  for test
Route::group(['prefix' => trans_setlocale().'/admin/test'], function () {
    Route::resource('test', 'Test\Test\Http\Controllers\TestAdminController');
});

// Admin API routes  for test
Route::group(['prefix' => trans_setlocale().'api/v1/admin/test'], function () {
    Route::resource('test', 'Test\Test\Http\Controllers\TestAdminApiController');
});

// User web routes for test
Route::group(['prefix' => trans_setlocale().'/user/tests'], function () {
    Route::resource('/', 'Test\Test\Http\Controllers\TestUserController');
});

// User API routes for test
Route::group(['prefix' => trans_setlocale().'api/v1/user/tests'], function () {
    Route::resource('/', 'Test\Test\Http\Controllers\TestUserApiController');
});

// Public web routes for test
Route::group(['prefix' => trans_setlocale().'/tests'], function () {
    Route::get('/', 'Test\Test\Http\Controllers\TestController@index');
    Route::get('/{slug?}', 'Test\Test\Http\Controllers\TestController@show');
});

// Public API routes for test
Route::group(['prefix' => trans_setlocale().'api/v1/tests'], function () {
    Route::get('/', 'Test\Test\Http\Controllers\TestApiController@index');
    Route::get('/{slug?}', 'Test\Test\Http\Controllers\TestApiController@show');
});

