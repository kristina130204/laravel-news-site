<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\BlacklistController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReplyController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index']);
Route::get('/cat/{category:slug}', [MainController::class, 'showCategory']);
Route::get('/cat/posts/{category:slug}', [PostController::class, 'showCategory']);
Route::get('/all-posts', [PostController::class, 'showPosts']);
Route::get('/users-posts/{user:id}', [PostController::class, 'showUsersPosts']);
Route::get('/tag/posts/{tag:slug}', [PostController::class, 'showTag']);
Route::get('/article/{article:slug}', [MainController::class, 'showArticle']);
Route::get('/post/{post:slug}', [MainController::class, 'showPost']);
Route::get('/tag/{tag:slug}', [MainController::class, 'showTag']);
Route::get('/mailing', [MainController::class, 'mailing']);
Auth::routes();
Route::get('search', [MainController::class, 'search']);
Route::get('search-ajax', [MainController::class, 'searchAjax']);
Route::get('search-posts', [MainController::class, 'searchPosts']);
Route::get('search-ajax-posts', [MainController::class, 'searchAjaxPosts']);
Route::get('/messages', [ChatController::class, 'fetchMessages']);
Route::post('/messages', [ChatController::class, 'sendMessage']);
Route::group(['middleware' => 'auth'], function () {
    Route::resource('posts', PostController::class);
    Route::post('/newComment', [MainController::class, 'newComment']);
    Route::post('/newReply', [MainController::class, 'newReply']);
    Route::post('/like', [MainController::class, 'like']);
    Route::resource('user', UserController::class);
    Route::get('/history', [UserController::class, 'history']);
    Route::get('/likes', [UserController::class, 'likes']);
    Route::get('/user-posts', [UserController::class, 'showPosts']);
    Route::get('/user-comments', [UserController::class, 'comments']);
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('categories', CategoryController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('replies', ReplyController::class);
    Route::resource('tags', TagController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class);
    Route::get('/blacklist', [BlacklistController::class, 'index']);
    Route::get('/comments-on-posts', [CommentController::class, 'onPosts']);
    Route::get('/messages', [ChatController::class, 'allMessages']);
    Route::delete('/message/{message}', [ChatController::class, 'deleteMessage']);
});
