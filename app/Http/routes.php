<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	return Redirect::route('dashboard');
});


Route::group(['middleware' => 'guest'], function(){
	Route::controller('password', 'RemindersController');
	Route::get('login', ['as'=>'login','uses' => 'Auth\AuthController@login']);
	Route::get('user/create', ['as'=>'user.create','uses' => 'UserController@create']);
	Route::post('user/store', ['as'=>'user.store','uses' => 'UserController@store']);
	Route::post('login', array('uses' => 'Auth\AuthController@doLogin'));


	// social login route
	Route::get('login/fb', ['as'=>'login/fb','uses' => 'SocialController@loginWithFacebook']);
	Route::get('login/gp', ['as'=>'login/gp','uses' => 'SocialController@loginWithGoogle']);

});



Route::group(array('middleware' => 'auth'), function()
{

	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
	Route::get('profile', ['as' => 'profile', 'uses' => 'UserController@profile']);
	Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'Auth\AuthController@dashboard'));
	Route::get('change-password', array('as' => 'password.change', 'uses' => 'Auth\AuthController@changePassword'));
	Route::post('change-password', array('as' => 'password.doChange', 'uses' => 'Auth\AuthController@doChangePassword'));

	Route::get('all-developer',['as' => 'developer.indexForDev', 'uses' => 'UserController@indexForDev']);

	Route::get('developer',['as' => 'developer.index', 'uses' => 'UserController@index']);
	Route::get('developer/create',['as' => 'developer.create', 'uses' => 'UserController@create']);
	Route::post('developer',['as' => 'developer.store', 'uses' => 'UserController@store']);
	Route::get('developer/{id}/edit',['as' => 'developer.edit', 'uses' => 'UserController@edit']);
	Route::get('developer/{id}/show',['as' => 'developer.show', 'uses' => 'UserController@show']);
	Route::put('developer/{id}',['as' => 'developer.update', 'uses' => 'UserController@update']);
	Route::delete('developer/{id}',['as' => 'developer.delete', 'uses' => 'UserController@destroy']);

	// Category CRUD
	Route::get('category',['as' => 'category.index', 'uses' => 'CategoryController@index']);
	Route::get('category/create',['as' => 'category.create', 'uses' => 'CategoryController@create']);
	Route::post('category',['as' => 'category.store', 'uses' => 'CategoryController@store']);
	Route::get('category/{id}/edit',['as' => 'category.edit', 'uses' => 'CategoryController@edit']);
	Route::get('category/{id}/show',['as' => 'category.show', 'uses' => 'CategoryController@show']);
	Route::put('category/{id}',['as' => 'category.update', 'uses' => 'CategoryController@update']);
	Route::delete('category/{id}',['as' => 'category.delete', 'uses' => 'CategoryController@destroy']);

	// Language CRUD
	Route::get('language',['as' => 'language.index', 'uses' => 'LanguageController@index']);
	Route::get('language/create',['as' => 'language.create', 'uses' => 'LanguageController@create']);
	Route::post('language',['as' => 'language.store', 'uses' => 'LanguageController@store']);
	Route::get('language/{id}/edit',['as' => 'language.edit', 'uses' => 'LanguageController@edit']);
	Route::get('language/{id}/show',['as' => 'language.show', 'uses' => 'LanguageController@show']);
	Route::put('language/{id}',['as' => 'language.update', 'uses' => 'LanguageController@update']);
	Route::delete('language/{id}',['as' => 'language.delete', 'uses' => 'LanguageController@destroy']);

	// Project CRUD
	Route::get('project',['as' => 'project.index', 'uses' => 'ProjectController@index']);
	Route::get('project/create',['as' => 'project.create', 'uses' => 'ProjectController@create']);
	Route::post('project',['as' => 'project.store', 'uses' => 'ProjectController@store']);
	Route::get('project/{id}/edit',['as' => 'project.edit', 'uses' => 'ProjectController@edit']);
	Route::get('project/{id}/show',['as' => 'project.show', 'uses' => 'ProjectController@show']);
	Route::put('project/{id}',['as' => 'project.update', 'uses' => 'ProjectController@update']);
	Route::delete('project/{id}',['as' => 'project.delete', 'uses' => 'ProjectController@destroy']);





/************************ EDITED BY MITHUN ************************/
   
   
   // Event CRUD
   Route::get('event',['as' => 'event.index', 'uses' => 'EventController@index']);
   Route::get('event/create',['as' => 'event.create', 'uses' => 'EventController@create']);
   Route::post('event',['as' => 'event.store', 'uses' => 'EventController@store']);
   Route::get('event/{id}/show',['as' => 'event.show', 'uses' => 'EventController@show']);
   Route::get('event/{id}/edit',['as' => 'event.edit', 'uses' => 'EventController@edit']);
   Route::put('project/{id}',['as' => 'project.update', 'uses' => 'ProjectController@update']);
   Route::delete('event/{id}',['as' => 'event.delete', 'uses' => 'eventController@destroy']);






});