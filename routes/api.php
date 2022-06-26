<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users','Api\UserController');
//Route::get('/users','Api\UserController@index');
//Route::get('/users/{id}','Api\UserController@show');