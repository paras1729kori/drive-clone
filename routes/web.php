<?php

use Illuminate\Support\Facades\Route;

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
// PAGES ROUTES
Route::get('/dash', 'PagesController@index')->name('pages.dash');
Route::get('/create', 'PagesController@create')->name('pages.create');
Route::get('/acc', 'PagesController@acc')->name('pages.account');


// File Controller Routes
Route::get('files/{id}', 'FilesController@index');
Route::post('files/store', 'FilesController@store');
Route::get('files/{id}/edit', 'FilesController@edit');
Route::delete('files/{id}/destroy', 'FilesController@destroy');


//Folder Controller Routes
Route::get('folders/{id}', 'FoldersController@index');
Route::post('folders/store', 'FoldersController@store');
Route::get('folders/{id}/edit', 'FoldersController@edit');
Route::post('folders/{id}/update', 'FoldersController@update');
Route::delete('folders/{id}/destroy', 'FoldersController@destroy');


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
