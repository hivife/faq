<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('login', 'AuthController@login');
    Route::get('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});
Auth::routes();

Route::get('/admin', 'AdminController@index');
Route::get('/edit/{question_id}/{answer}/{question}/{category_id}', 'AdminController@editquestion');
Route::get('/create/{question}/{answer}/{category_id}', 'AdminController@createquestion');
Route::get('/admin/publish/{question_id}', 'AdminController@publish');
Route::get('/admin/category/publish/{question_id}', 'AdminController@publishcat');
Route::get('/admin/category/private/{question_id}', 'AdminController@privatecat');
Route::get('/admin/category/delete/{question_id}', 'AdminController@deletecat');
Route::get('/admin/create', 'AdminController@create');
Route::get('/admin/category', 'AdminController@category');
Route::get('/admin/edit/{question_id}', 'AdminController@edit')->name('edit');
Route::get('/home', 'HomeController@index')->name('home');



