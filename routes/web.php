<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function(){
    return view('home');
});

Route::get('/category/search','CategoriesController@search')->name('category.search');
Route::get('/category/trash','CategoriesController@trash')->name('category.trash');
Route::get('/category/restore/{id}','CategoriesController@restore')->name('category.restore');
Route::delete('/category/kill/{id}','CategoriesController@kill')->name('category.kill');
Route::resource('/category','CategoriesController');