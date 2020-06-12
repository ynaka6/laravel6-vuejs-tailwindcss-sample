<?php

use Illuminate\Http\Request;
// use Auth;
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

Route::post('login')->uses('Admin\Api\Auth\LoginController@login')->name('login');
Route::post('logout')->uses('Admin\Api\Auth\LoginController@logout')->name('logout');
Route::get('my')->uses('Admin\Api\Auth\MyController')->name('my');
Route::get('config')->uses('Admin\Api\ConfigController')->name('config');


Route::get('staffs')->uses('Admin\Api\PaginationController')->name('admin.pagination');
Route::post('staff')->uses('Admin\Api\CreateController')->name('admin.create');
Route::get('staff/{id}')->uses('Admin\Api\ShowController')->name('admin.show');
Route::put('staff/{id}')->uses('Admin\Api\UpdateController')->name('admin.update');
Route::delete('staff/{id}')->uses('Admin\Api\DeleteController')->name('admin.delete');