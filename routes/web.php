<?php
use Illuminate\Support\Facades\Route;
use \UniSharp\LaravelFilemanager\Lfm;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', function () {
    return view('welcome');
});
                    // @if(!Auth::guest() and Auth::user()->is_active and Auth::user()->role->name == 'administrator')
                    //    <li><a href="{{route('admin.users.index')}}" title="Administrator's Homepage">Admin Dashboard</a></li>
                    // @endif

Route::get('/home', 'HomeController@index');

Route::get('/post/{id}',['as' => 'home.post','uses'=>'AdminPostsController@post']);

Route::group(['middleware'=>'admin'],function(){
	Route::get('/admin',function(){
		return view('admin.index');
	});


	Route::resource('admin/users','AdminUsersController',['names'=>[
		'index'  => 'admin.users.index',
		'create' => 'admin.users.create',
		'store'  => 'admin.users.store',
		'edit'   => 'admin.users.edit'

	]]);

	Route::resource('admin/posts','AdminPostsController',['names'=>[
		'index'  => 'admin.posts.index',
		'create' => 'admin.posts.create',
		'store'  => 'admin.posts.store',
		'edit'   => 'admin.posts.edit'
	]]);

	Route::resource('admin/comments','PostCommentsController',['names'=>[
		'index'  => 'admin.comments.index',
		'show'   => 'admin.comments.show',
		'create' => 'admin.comments.create',
		'edit'   => 'admin.comments.edit',
		'show'   => 'admin.comments.show'
	]]);

	Route::resource('admin/categories','AdminCategoriesController',['names'=>[
		'index'  => 'admin.categories.index',
		'edit'   => 'admin.categories.edit',
		'store'  => 'admin.categories.store',
		'create' => 'admin.categories.create'
	]]);

	Route::resource('admin/media','AdminMediasController',['names'=>[
		'index'    => 'admin.media.index',
		'create'   => 'admin.media.create',
		'store'    => 'admin.media.store',
		'edit'     => 'admin.media.edit'
	]]);

	Route::resource('admin/comments/replies','CommentRepliesController',['names'=>[
		'index'    => 'admin.comments.replies.index',
		'show'     => 'admin.comments.replies.show'
	]]);

	Route::post('admin/delete/media','AdminMediasController@deleteMedia');
});

Route::group(['middleware'=>'auth'],function(){
	Route::post('admin/comments/reply','CommentRepliesController@createReply');
});



// Route::get('/post/{id}',['as' => 'home.post','uses'=>'AdminPostsController@post']);

// Route::group(['middleware'=>'admin'],function(){
// 	Route::get('/admin',function(){
// 		return view('admin.index');
// 	});

// 	Route::resource('admin/users','AdminUsersController');

// 	Route::resource('admin/posts','AdminPostsController');

// 	Route::resource('admin/categories','AdminCategoriesController');

// 	Route::resource('admin/media','AdminMediasController');

// 	Route::resource('admin/comments','PostCommentsController');

// 	Route::resource('admin/comments/replies','CommentRepliesController');
// 	//Route::get('admin/media/upload',['as' => 'admin.media.upload']);
// });

// Route::group(['middleware'=>'auth'],function(){
// 	Route::post('admin/comments/reply','CommentRepliesController@createReply');
// });
