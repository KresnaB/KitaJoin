<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});

Route::get('add/{id}', 'ProfilesController@add');
Route::get('profiles', 'ProfilesController@index');
Route::get('profiles/{id}', 'ProfilesController@profile');
Route::post('update/{id}', 'ProfilesController@update');

Route::get('posts/{id}', 'PostsController@show');
Route::get('posts/show/{user_id}', 'PostsController@showByUserId');
Route::get('posts', 'PostsController@index');
Route::post('post/create', 'PostsController@store');
Route::post('post/update/{id}', 'PostsController@update');
Route::delete('post/delete/{id}', 'PostsController@delete');

Route::post('follow/{id}', 'FollowsController@store');
Route::get('followers/{post_id}', 'FollowsController@notify');
Route::post('accept/{post_id}/{user_id}', 'FollowsController@update');
//Route::delete('decline/{post_id}/{user_id}', 'FollowsController@delete');

Route::get('searchresult/{post_name}', 'SearchController@search_result');
Route::get('filterresult/{category}', 'SearchController@filter_result');