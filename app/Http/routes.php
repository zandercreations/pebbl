<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'uses' => '\Pebbl\Http\Controllers\HomeController@index',
    'as' => 'home',
]);

Route::get('/alert', function () {
    return redirect()->route('home')->with('info', 'you have signed up!');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    
    /*
    * Home
    */
    
    Route::get('/', [
    'uses' => '\Pebbl\Http\Controllers\HomeController@index',
    'as' => 'home',
]);

Route::get('/alert', function () {
    return redirect()->route('home')->with('info', 'you have signed up!');
});
    
    
    /*
    * authentication
    */
    
    Route::get('/signup', [
    'uses' => '\Pebbl\Http\Controllers\AuthController@getSignup',
    'as' => 'auth.signup',
    'middleware' => ['guest'],
        ]);
    
    Route::post('/signup', [
    'uses' => '\Pebbl\Http\Controllers\AuthController@postSignup',
    'middleware' => ['guest'],
        ]);
    
    Route::get('/signin', [
    'uses' => '\Pebbl\Http\Controllers\AuthController@getSignin',
    'as' => 'auth.signin',
    'middleware' => ['guest'],
        ]);
    
    Route::post('/signin', [
    'uses' => '\Pebbl\Http\Controllers\AuthController@postSignin',
    'middleware' => ['guest'],
        ]);
    
    Route::get('/signout', [
    'uses' => '\Pebbl\Http\Controllers\AuthController@getSignout',
    'as' => 'auth.signout',
        ]);
    
    
    /*
    * Search
    */
    //
    
    Route::get('/search', [
    'uses' => '\Pebbl\Http\Controllers\SearchController@getResults',
    'as' => 'search.results',
        ]);
    
    
     /*
    * User Profile
    */
    
     Route::get('/user/{username}', [
    'uses' => '\Pebbl\Http\Controllers\ProfileController@getProfile',
    'as' => 'profile.index',
        ]);
    
    
    Route::get('/profile/edit', [
    'uses' => '\Pebbl\Http\Controllers\ProfileController@getEdit',
    'as' => 'profile.edit',
    'middleware' => ['auth'],
        ]);
    
    
    Route::post('/profile/edit', [
    'uses' => '\Pebbl\Http\Controllers\ProfileController@postEdit',
    'middleware' => ['auth'],
        ]);
    
      /*
    * friends
    */
    
    Route::get('/friends', [
    'uses' => '\Pebbl\Http\Controllers\FriendController@getIndex',
    'as' => 'friend.index',
    'middleware' => ['auth'],
        ]);
    
    Route::get('/friends/add/{username}', [
    'uses' => '\Pebbl\Http\Controllers\FriendController@getAdd',
    'as' => 'friend.add',
    'middleware' => ['auth'],
        ]);
    
    
    Route::get('/friends/accept/{username}', [
    'uses' => '\Pebbl\Http\Controllers\FriendController@getAccept',
    'as' => 'friend.accept',
    'middleware' => ['auth'],
        ]);
    
    Route::post('/friends/delete/{username}', [
    'uses' => '\Pebbl\Http\Controllers\FriendController@postDelete',
    'as' => 'friend.delete',
    'middleware' => ['auth'],
        ]);
    
    /*
    * Statuses
    */
    
    Route::post('/status', [
    'uses' => '\Pebbl\Http\Controllers\StatusController@postStatus',
    'as' => 'status.post',
    'middleware' => ['auth'],
        ]);
    
    Route::post('/status/{statusId}/reply', [
    'uses' => '\Pebbl\Http\Controllers\StatusController@postReply',
    'as' => 'status.reply',
    'middleware' => ['auth'],
        ]);
    
    Route::get('/status/{statusId}/like', [
    'uses' => '\Pebbl\Http\Controllers\StatusController@getLike',
    'as' => 'status.like',
    'middleware' => ['auth'],
        ]);
});
