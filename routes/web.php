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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//agar tidak memiliki fitur registrasi kemudian redirect ke halaman login
Route::match(["GET", "POST"], "/register", function(){
    return redirect("/login"); 
})->name("register");

Route::resource("users", "UserController"); //users/action cth users/create 


// Route::get('/ajax/categories/search','CategoryController@ajaxSearch');

//Membuat list categories
Route::get('/categories/trash', 'CategoryController@trash')->name('categories.trash'); //membuat recycle bin
Route::get('/categories/{id}/restore','CategoryController@restore')->name('categories.restore'); //mengembalikan data dari recycle bin
Route::delete('/categories/{id}/deletepermanent','CategoryController@deletepermanent')->name('categories.deletepermanent');
Route::resource('categories',"CategoryController"); //untuk menjalankan fungsionalitas category
Route::get('/ajax/categories/search','CategoryController@ajaxSearch');

//Membuat list books
Route::get('/books/trash', 'BookController@trash')->name('books.trash');
Route::get('/categories/{id}/restore','BookController@restore')->name('books.restore'); //mengembalikan data dari recycle bin
Route::delete('/categories/{id}/deletepermanent','BookController@deletepermanent')->name('books.deletepermanent');
Route::resource('books','Bookcontroller');