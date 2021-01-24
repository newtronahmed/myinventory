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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/add-product','ProductsController@store')->name('products.store');
Route::get('/profile/edit','HomeController@edit')->name('profile.edit');
Route::get('/neworders','OrdersController@create')->name('neworders');
Route::patch('/profile/edit','HomeController@update')->name('profile.update');
Route::post('/add-category','CategoriesController@store')->name('categories.store');
Route::post('/add-brand','BrandsController@store')->name('brands.store');
Route::get('/products/manage','ProductsController@edit')->name('products.manage');
Route::get('/products','ProductsController@index');
Route::get('/products/{id}','ProductsController@show');
Route::get('/download-pdf/{hash_Id}','ordersController@show')->name('download.show');
Route::patch('/products/edit/{product}','ProductsController@update')->name('products.update');
Route::get('/products/delete/{product}','ProductsController@trash');
Route::get('/category/manage','CategoriesController@edit')->name('categories.manage');
Route::patch('/category/edit/{category}','CategoriesController@update');
Route::get('/brand/manage','BrandsController@edit')->name('brands.manage');
Route::patch('/brand/edit/{brand}','BrandsController@update');
Route::get('/category/delete/{category}','CategoriesController@delete');
Route::get('/brand/delete/{brand}','BrandsController@delete');
Route::get('/download/pdf/{hash_Id}','ordersController@createPDF');
Route::post('/neworder','OrdersController@store')->name('order.store');

