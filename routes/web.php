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

Route::get('/category', 'faq@category');
Route::get('/question/{category_id}', 'faq@get_question');
Route::get('/rate/{question_id}/{rating}', 'faq@rate');
//Route::post('/ratepost/', 'faq@ratepost');	
Route::get('/search/{keyword}', 'faq@search');


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

Route::get('/home', 'HomeController@index')->name('home');
