<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('categories_store','coursesapiController@categories_store');
Route::get('categories_show/{id}', 'coursesapiController@categories_show');
Route::get('all_categories', 'coursesapiController@all_categories');
Route::post('category_update', 'coursesapiController@category_update');
Route::get('category_destroy/{id}', 'coursesapiController@category_destroy');

Route::post('instructor_store','coursesapiController@instructor_store');
Route::get('instructor_show/{id}', 'coursesapiController@instructor_show');
Route::get('all_instructors', 'coursesapiController@all_instructors');
Route::post('instructor_update', 'coursesapiController@instructor_update');
Route::get('instructor_destroy/{id}', 'coursesapiController@instructor_destroy');

Route::post('course_store','coursesapiController@course_store');
Route::get('course_show/{id}', 'coursesapiController@course_show');
Route::get('all_courses', 'coursesapiController@all_courses');
Route::post('course_update', 'coursesapiController@course_update');
Route::get('course_destroy/{id}', 'coursesapiController@course_destroy');

Route::get('front_detail','coursesapiController@front_detail');
Route::get('front_detail/{id}','coursesapiController@front_detail');
Route::get('front_feature/{id}','coursesapiController@front_feature');
Route::get('front_instructor/{id}','coursesapiController@front_instructor');
Route::get('front_add_to_cart/{id}','coursesapiController@add_to_cart');
Route::get('my_cart/{id}','coursesapiController@my_cart');