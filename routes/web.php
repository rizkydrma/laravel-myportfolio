<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'BlogsController@index')->name('blog');

// Route BLOG
Route::get('/blog/cari', 'BlogsController@search')->name('blog.search');
Route::get('/blog', 'BlogsController@blog')->name('blog.blog');
Route::get('/blog/{slug}', 'BlogsController@blog_detail')->name('blog.detail');
Route::get('/list-category/{category}', 'BlogsController@list_category')->name('blog.category');
Route::get('/list-tag/{tag}', 'BlogsController@list_tag')->name('blog.tag');

Route::post('/blog/{post}/comment', 'PostCommentController@store')->name('blog.comment.store');

// Route Source
Route::get('/source/cari','SourcesController@search')->name('source.search');
Route::get('/source', 'SourcesController@index')->name('source');
Route::get('/list-source-category/{slug}', 'SourcesController@source_detail')->name('source.detail');
Route::get('/list-source-tag/{tag}', 'SourcesController@list_tag')->name('source.tag');

Route::post('/source/{sourcecode}/comment', 'PostCommentController@store_source')->name('source.comment.store');

Route::resource('/video-tutorial','VideosController');

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

    //Route Source Code
    Route::get('/sourcecode/search','SourcecodesController@search')->name('sourcecode.search');
    Route::get('/sourcecode/trash','SourcecodesController@trash')->name('sourcecode.trash');
    Route::get('/sourcecode/restore/{id}','SourcecodesController@restore')->name('sourcecode.restore');
    Route::delete('/sourcecode/kill/{id},{image}','SourcecodesController@kill')->name('sourcecode.kill');
    Route::get('/sourcecode/deleteAll','SourcecodesController@deleteAll')->name('sourcecode.deleteAll');
    Route::resource('/sourcecode', 'SourcecodesController');

    // Route Commentar
    Route::get('/post-comment/search','PostCommentController@search')->name('post-comment.search');
    Route::get('/post-comment', 'PostCommentController@show_post')->name('post-comment.show');
    Route::delete('/post-comment/{comment}', 'PostCommentController@destroy_post')->name('post-comment.destroy');
    Route::get('/post-comment/deleteAll','PostCommentController@deleteAll')->name('post-comment.deleteAll');

    Route::get('/source-comment/search','PostCommentController@search_source')->name('source-comment.search');
    Route::get('/source-comment', 'PostCommentController@show_source')->name('source-comment.show');
    Route::delete('/source-comment/{sourcecomment}', 'PostCommentController@destroy_source')->name('source-comment.destroy');
    Route::get('/source-comment/deleteAll','PostCommentController@deleteAll_source')->name('source-comment.deleteAll');
    

    // Route Bio
    Route::get('/bio','BiosController@index')->name('bio.index');
    Route::post('/bio/{bio}','BiosController@update')->name('bio.update');
    
    // Route Skill
    Route::post('/skill', 'BiosController@store_skill')->name('skill.store');
    Route::get('/skill/{skill}/edit', 'BiosController@edit_skill')->name('skill.edit');
    Route::put('/skill/{skill}','BiosController@update_skill')->name('skill.update');
    Route::delete('/skill/{skill}','BiosController@delete_skill')->name('skill.delete');

    // Route Project
    Route::resource('/project', 'ProjectsController');

});

