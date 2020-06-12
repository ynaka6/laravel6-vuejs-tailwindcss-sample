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

Route::post('register')->uses('App\Api\Auth\RegisterController@register')->name('register');
Route::get('verify')->uses('App\Api\Auth\VerificationController@verify')->name('api.verify');
Route::post('initileze')->uses('App\Api\Auth\InitializeController@register')->middleware('auth');
Route::post('login')->uses('App\Api\Auth\LoginController@login')->name('login');
Route::post('logout')->uses('App\Api\Auth\LoginController@logout')->name('logout');
Route::post('password/send-reset-link')->uses('App\Api\Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset')->uses('App\Api\Auth\ResetPasswordController@reset');
Route::post('password/change')->uses('App\Api\Auth\ChangePasswordController');
Route::post('email/reset')->uses('App\Api\Auth\ResetEmailController@reset');
Route::get('email/accept')->uses('App\Api\Auth\ResetEmailController@accept')->name('api.email.accept');


Route::get('my')->uses('App\Api\MyController');
Route::get('my/activities')->uses('App\Api\My\ActivityController')->middleware('auth');


Route::get('user/{userId}')->uses('App\Api\UserController@show');
Route::post('/user/{userId}/follow')->name('follow')->uses('App\Api\User\RelationshipController@store');
Route::delete('/user/{userId}/unfollow')->name('unfollow')->uses('App\Api\User\RelationshipController@destroy');
Route::put('user/profile/update')->uses('App\Api\User\ProfileController@update')->middleware('auth');


Route::get('config')->uses('App\Api\ConfigController')->name('config');


Route::get('companies')->uses('App\Api\CompanyController@index');
Route::get('address/search')->uses('App\Api\Address\SearchController');
