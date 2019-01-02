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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {

	// modulle user
	Route::prefix('users')->group(function () {

		// list user
		Route::get('/', [
			'as'         => 'user.index',
			'uses'       => 'UserController@index',
			'middleware' => 'check.permission:download-cv',
		]);

		// create user
		Route::get('/create', [
			'as'         => 'user.add',
			'uses'       => 'UserController@create',
			'middleware' => 'check.permission:user-add',
		]);
		Route::post('/create', 'UserController@store')->name('user.store');
		// edit user
		Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
		Route::post('/edit/{id}', 'UserController@update')->name('user.edit');
		// delete user
		Route::get('/delete/{id}', 'UserController@delete')->name('user.delete');

	});

	// module role

	Route::prefix('roles')->group(function () {

		// list role
		Route::get('/',
			[
				'as'   => 'role.index',
				'uses' => 'RoleController@index',
				// 'middleware' => 'check.permission:role-list',
			]);
		// create role
		Route::get('/create', 'RoleController@create')->name('role.add');
		Route::post('/create', 'RoleController@store')->name('role.store');
		// edit role
		Route::get('/edit/{id}', 'RoleController@edit')->name('role.edit');
		Route::post('/edit/{id}', 'RoleController@update')->name('role.edit');
		// delete role
		Route::get('/delete/{id}', 'RoleController@delete')->name('role.delete');

	});

	// module permission

	Route::prefix('permissions')->group(function () {

		// list role
		Route::get('/',
			[
				'as'   => 'permission.index',
				'uses' => 'PermissionController@index',
				// 'middleware' => 'check.permission:role-list',
			]);
		// create role
		Route::get('/create', 'PermissionController@create')->name('permission.add');
		Route::post('/create', 'PermissionController@store')->name('permission.store');
		// edit role
		Route::get('/edit/{id}', 'PermissionController@edit')->name('permission.edit');
		Route::post('/edit/{id}', 'PermissionController@update')->name('permission.edit');
		// delete role
		Route::get('/delete/{id}', 'PermissionController@delete')->name('permission.delete');

	});
});
