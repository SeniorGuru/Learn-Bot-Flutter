<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
	
    return $request->user();
});

Route::group(['prefix' => 'auth'], function() {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
});

Route::group(['prefix' => 'lang'], function() {
    Route::get('readAll', 'LanguageController@readAll');
});

Route::group(['prefix' => 'verb'], function() {
    Route::post('readAllOfLang', 'VerbController@readAllofLang');
    Route::post('readOfInfinitiv', 'VerbController@readOfInfinitiv');
});

Route::post('searchInfinitiv', 'SearchController@searchInfinitiv');