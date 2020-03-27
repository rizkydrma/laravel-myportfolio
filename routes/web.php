<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function(){
    return view('home');
});

// Route Category
Route::get('/category/search','CategoriesController@search')->name('category.search');
Route::get('/category/trash','CategoriesController@trash')->name('category.trash');
Route::get('/category/restore/{id}','CategoriesController@restore')->name('category.restore');
Route::delete('/category/kill/{id}','CategoriesController@kill')->name('category.kill');
Route::get('/category/deleteAll','CategoriesController@deleteAll')->name('category.deleteAll');
Route::resource('/category','CategoriesController');

// Route Tags
Route::get('/tag/search','TagsController@search')->name('tag.search');
Route::get('/tag/trash','TagsController@trash')->name('tag.trash');
Route::get('/tag/restore/{id}','TagsController@restore')->name('tag.restore');
Route::delete('/tag/kill/{id}','TagsController@kill')->name('tag.kill');
Route::get('/tag/deleteAll','TagsController@deleteAll')->name('tag.deleteAll');
Route::resource('/tag','TagsController');

// Route Post
Route::get('/post/search','PostsController@search')->name('post.search');
Route::get('/post/trash','PostsController@trash')->name('post.trash');
Route::get('/post/restore/{id}','PostsController@restore')->name('post.restore');
Route::delete('/post/kill/{id},{image}','PostsController@kill')->name('post.kill');
Route::get('/post/deleteAll','PostsController@deleteAll')->name('post.deleteAll');
Route::resource('/post','PostsController');

Route::group(['middleware' => 'auth'], function(){
    
});