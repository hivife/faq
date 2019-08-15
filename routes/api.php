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
|*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
		Route::post('category1', 'faqprivate@category');
		Route::post('question1', 'faqprivate@question');
		Route::post('search1', 'faqprivate@search');
    });

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
   Route::post('signup', 'AuthController@signup');
});
Route::post('/rate/', 'faq@rate');
Route::post('/category/', 'faq@category');
Route::post('/question/', 'faq@question');
Route::post('/search/', 'faq@search');


?>
