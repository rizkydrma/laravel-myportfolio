<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'BlogsController@index')->name('blog');

// Route BLOG
Route::get('/blog/cari', 'BlogsController@search')->name('blog.search');
Route::get('/blog', 'BlogsController@blog')->name('blog.blog');
Route::get('/blog/{slug}', 'BlogsController@blog_detail')->name('blog.detail');
Route::get('/list-category/{category}', 'BlogsController@list_category')->name('blog.category');


Route::get('/source-code', 'SourcesController@index')->name('source-code');
Route::get('/video-tutorial', 'BlogsController@tutorial')->name('blog.tutorial');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    
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

    //Route User
    Route::get('/user/search','UsersController@search')->name('user.search');
    Route::get('/user/trash','UsersController@trash')->name('user.trash');
    Route::get('/user/restore/{id}','UsersController@restore')->name('user.restore');
    Route::delete('/user/kill/{id}','UsersController@kill')->name('user.kill');
    Route::get('/user/deleteAll','UsersController@deleteAll')->name('user.deleteAll');
    Route::resource('/user', 'UsersController');
});

