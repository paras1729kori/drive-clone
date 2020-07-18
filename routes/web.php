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
Route::get('/create', 'PagesController@create')->name('pages.create');
Route::get('/', 'PagesController@acc')->name('pages.account');
Route::get('/search', 'PagesController@search');
//for downloading files on home
Route::get('download/{id}', 'PagesController@download')->name('downloadfileindash');


// File Controller Routes
Route::get('/home', 'FilesController@index');
Route::post('files/store', 'FilesController@store');
Route::delete('files/{id}/destroy', 'FilesController@destroy');


//Folder Controller Routes
Route::get('folders/{id}', 'FoldersController@index')->name('folders.index');
Route::post('folders/store', 'FoldersController@store');
Route::get('folders/{id}/edit', 'FoldersController@edit')->name('folders.edit');
Route::post('folders/{id}/update', 'FoldersController@update');
Route::delete('folders/{id}/destroy', 'FoldersController@destroy');
//for downloading files in folders
Route::get('folders/download/{id}', 'FoldersController@download')->name('downloadfileinfols');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
