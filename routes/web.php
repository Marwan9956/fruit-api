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

Route::get('/', function(){
    return view('welcome');
});

/*
*/

Route::group(['prefix' => '/api/v1/'],function(){

	Route::group(['prefix' => 'user'] , function(){
		Route::get('get' , 'UserController@getAllUser');
		Route::get('get/{id}', 'UserController@getUserByID');

		Route::post('signup' , 'UserController@signup');
		Route::put('update/{id}' , 'UserController@update');
		Route::delete('delete/{id}','UserController@delete');
	});

	Route::group(['prefix' => 'news/'],function() {
		Route::get('get', 'NewsController@getAll');
		Route::get('get/{id}' , 'NewsController@getSingle');
		/**
		* Autenticate those routes
		*/
		Route::post('' , 'NewsController@store');
		Route::put('update/{id}' , 'NewsController@update');
		Route::delete('delete/{id}' , 'NewsController@delete');

	});

	Route::group(['prefix' => 'category/'],function(){
		Route::get('get' , 'CategoryController@getAll');
		Route::get('get/{id}' , 'CategoryController@getSingle');
		/**
		 * Authenticate these Routes
		 */
		Route::post('store','CategoryController@store');
		Route::put('update/{id}' , 'CategoryController@update');
		Route::delete('delete/{id}' , 'CategoryController@delete');
	});
    
});
