<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'App\Http\Controllers\Api\Auth\LoginController@login');
Route::post('register', 'App\Http\Controllers\UserController@register');

Route::post('add/story','App\Http\Controllers\Api\StoriesController@make');
Route::get('get/stories','App\Http\Controllers\Api\StoriesController@getAll');
Route::delete('delete/story','App\Http\Controllers\Api\StoriesController@deleteStory');

Route::post('add/publication','App\Http\Controllers\Api\PublicationsController@create');
Route::get('get/publications','App\Http\Controllers\Api\PublicationsController@getAll');
Route::delete('delete/publication','App\Http\Controllers\Api\PublicationsController@deletePublication');
Route::post('download/publication','App\Http\Controllers\Api\PublicationsController@download');

Route::post('add/image','App\Http\Controllers\Api\ImageGalleriesController@create');



