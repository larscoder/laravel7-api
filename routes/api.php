<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('sanctum/token', 'UserTokenController');

Route::apiResource('products', 'ProductController')
    ->middleware('auth:sanctum');
Route::apiResource('categories', 'CategoryController')
    ->middleware('auth:sanctum');

Route::post('newsletter', 'NewsletterController@send');
