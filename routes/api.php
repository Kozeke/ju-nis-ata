<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StoriesController;
use App\Http\Controllers\Api\PublicationsController;
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
Route::resources([
    'stories' => StoriesController::class,
    'publications' => PublicationsController::class
]);

Route::post('download/publication','App\Http\Controllers\Api\PublicationsController@download');




