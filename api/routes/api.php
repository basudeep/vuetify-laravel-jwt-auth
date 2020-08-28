<?php



Route::group(['prefix' => 'auth', 'namespace' =>'Auth'], function(){
    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');
    Route::get('user', 'UserController');
    Route::post('register', 'RegisterController');
});


Route::group(['prefix' => 'post', 'middleware' => 'auth:api', 'namespace' => 'Post'],function(){
    Route::get('timeline', 'TimeLineController');
});