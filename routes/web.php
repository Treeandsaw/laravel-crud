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

Auth::routes(); 

Route::get('/', 'PostController@index');
Route::get('/home', 'PostController@index');

Route::resource('posts', 'PostController');

Route::get('about', 	'HomeController@about');
Route::get('contact', 	'HomeController@contact');
Route::get('loginplz', 	'HomeController@loginplz');


Route::get('logout', 'LoginController@logout');
Route::get('avatar', 'PostController@avatar');

Route::get('search', ['as' => 'search', 'uses' => 'PostController@searchinput']);
 
Route::get('avatar/search/{search}', 'PostController@search');
 

Route::post('profile', 'PostController@update_avatar');


Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');

Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);

//Comments
Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store' ]);
Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);

//Replies
Route::post('reply/{post_id}', ['uses' => 'ReplyController@store', 'as' => 'reply.store' ]);
Route::get('reply/{id}/edit', ['uses' => 'ReplyController@edit', 'as' => 'reply.edit']);
Route::put('reply/{id}', ['uses' => 'ReplyController@update', 'as' => 'reply.update']);
Route::delete('reply/{id}', ['uses' => 'ReplyController@destroy', 'as' => 'reply.destroy']);
Route::get('reply/{id}/delete', ['uses' => 'ReplyController@delete', 'as' => 'reply.delete']);

  