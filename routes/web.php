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
Route::get('/home', 'PagesController@index');
Route::get('/create', 'PagesController@create')->name('pages.create');
Route::get('/', 'PagesController@acc')->name('pages.account');
// for searching files and folders
Route::get('/search', 'PagesController@search');
//for downloading files on home
Route::get('download/{id}', 'PagesController@download')->name('downloadfileindash');

// File Controller Routes
Route::post('files/store', 'FilesController@store');
Route::delete('files/{id}/destroy', 'FilesController@destroy');
//to selected folder
Route::delete('/tofolderfiles', 'FilesController@to_folder');
//to starred
Route::delete('/tostarredfiles','FilesController@to_starred');
//to favs
Route::delete('/tofavsfiles','FilesController@to_favs');
//delete all files route
Route::delete('/deleteall','FilesController@deleteAll');
//for updating files path
Route::post('/files/parentfiles', 'FilesController@parentfiles');

//Folder Controller Routes
//for showing specific files and folders in starred
Route::get('folders/2', 'FoldersController@starred');
//for showing specific files and folders in favourites
Route::get('folders/3', 'FoldersController@favourites');
//to move folders to selected folder
Route::get('/tofolderfold', 'FoldersController@to_folder');
//to starred
Route::get('/tostarredfold','FoldersController@to_starred');
//to favs
Route::get('/tofavsfold','FoldersController@to_favs');
//for showing files and folders in any other folders user_created_ones
Route::get('folders/{id}', 'FoldersController@index');
Route::post('folders/store', 'FoldersController@store');
Route::get('folders/{id}/edit', 'FoldersController@edit')->name('folders.edit');
Route::post('folders/{id}/update', 'FoldersController@update');
//for updating parentfolders of folders
Route::post('folders/parentfols', 'FoldersController@parentfols');
Route::delete('folders/{id}/destroy', 'FoldersController@destroy');
//for downloading files in folders
Route::get('folders/download/{id}', 'FoldersController@download')->name('downloadfileinfols');

Auth::routes();

//Admin Middleware Controller Routes
Route::group(['middleware' => ['auth', 'admin']], function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('/dashboard','Admin\AdminController@index');
    Route::get('/registerrole','Admin\AdminController@register');
    Route::get('/registeredit/{id}','Admin\AdminController@registeredit');
    Route::put('/registerupdate/{id}','Admin\AdminController@registerupdate');
    Route::delete('/registerdelete/{id}','Admin\AdminController@registerdelete');

    Route::get('/tasks','Admin\TasksController@index');
    Route::post('/savetasks','Admin\TasksController@store');
    Route::get('/tasks/{id}','Admin\TasksController@edit');
    Route::put('/tasksupdate/{id}','Admin\TasksController@update');
    Route::delete('/tasksdelete/{id}','Admin\TasksController@delete');
});
