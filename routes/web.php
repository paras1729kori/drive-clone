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

// FILE ROUTES
//replace files
Route::get('/replace', 'FilesController@replace');
//to selected folder
Route::get('/tofolderfiles', 'FilesController@to_folder');
//to starred
Route::get('/tostarredfiles','FilesController@to_starred');
//to favs
Route::get('/tofavsfiles','FilesController@to_favs');
//to remove files from starred
Route::get('/removestarred','FilesController@remove_fils_starred');
//to remove files from favs
Route::get('/removefavs','FilesController@remove_fils_favs');
//delete all files route
Route::get('/deleteall','FilesController@deleteAll');
//for updating files path
Route::post('/files/parentfiles', 'FilesController@parentfiles');
Route::post('files/store', 'FilesController@store');
Route::get('files/{id}/destroy', 'FilesController@destroy');

//FOLDER ROUTES
//for showing specific files and folders in important
Route::get('important', 'FoldersController@important');
//for showing specific files and folders in starred
Route::get('starred', 'FoldersController@starred');
//for showing specific files and folders in favourites
Route::get('favourites', 'FoldersController@favourites');
//for showing files and folders for admins
Route::get('important/{id}', 'FoldersController@admin');
//for showing files and folders for employees
Route::get('employees/{id}', 'FoldersController@employee');
//to move folders to selected folder
Route::get('/tofolderfold', 'FoldersController@to_folder');
//to starred
Route::get('/tostarredfold','FoldersController@to_starred');
//to favs
Route::get('/tofavsfold','FoldersController@to_favs');
//remove folder from starred
Route::get('/removefolstar','FoldersController@remove_fols_starred');
//remove folder from favs
Route::get('/removefolfavs','FoldersController@remove_fols_favs');
Route::post('folders/store', 'FoldersController@store');
Route::get('folders/{id}/edit', 'FoldersController@edit')->name('folders.edit');
Route::post('folders/{id}/update', 'FoldersController@update');
//for updating parentfolders of folders
Route::post('folders/parentfols', 'FoldersController@parentfols');
Route::delete('folders/{id}/destroy', 'FoldersController@destroy');
//for downloading files in folders
Route::get('folders/download/{id}', 'FoldersController@download')->name('downloadfileinfols');

//POSTS ROUTES
Route::resource('posts', 'PostsController');

//AUTH ROUTES
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
