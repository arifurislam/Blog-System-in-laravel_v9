<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// website
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FrontendPostController;
use App\Http\Controllers\CommentController;


// admin
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Postcontroller;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\FavoriteAdminController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AdminComment;
use App\Http\Controllers\Admin\AuthorInfoController;

// author
use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Author\AuthorPostController;
use App\Http\Controllers\Author\SettingAuthorController;
use App\Http\Controllers\Author\FavoriteAuthorController;
use App\Http\Controllers\Author\AuthorComment;

// admin
Route::group(['as'=>'admin.', 'prefix' => 'admin', 'middleware'=>['auth','admin']], function () {
    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::resource('/tags', TagController::class)->except([
        'show'
    ]);
    Route::resource('/categories', CategoryController::class)->except([
        'show'
    ]);
    Route::resource('/posts', Postcontroller::class);
    Route::get('panding/posts', [Postcontroller::class, 'pendingPost']);
    Route::put('panding/posts/approved/{id}', [Postcontroller::class, 'approvedPost']);
    Route::get('subscribers', [SubscriberController::class, 'index']);
    Route::delete('subscribers/delete/{id}', [SubscriberController::class, 'delete']);
    Route::get('settings/', [SettingsController::class, 'edit']);
    Route::put('settings/update', [SettingsController::class, 'update']);
    Route::put('password/update', [SettingsController::class, 'updatePassword']);
    Route::get('favorites', [FavoriteAdminController::class, 'index']);
    Route::get('comments', [AdminComment::class, 'index']);
    Route::delete('comments/destroy/{id}', [AdminComment::class, 'destroy']);
    Route::get('authors', [AuthorInfoController::class, 'index']);
    Route::delete('authors/delete', [AuthorInfoController::class, 'trash']);

});

// author
Route::group(['as'=>'author.', 'prefix' => 'author', 'middleware'=>['auth','author']], function () {
    Route::get('/dashboard', [AuthorController::class, 'index']);
    Route::resource('/posts', AuthorPostController::class);
    Route::get('favorites', [FavoriteAuthorController::class, 'index']);
    Route::get('settings/', [SettingAuthorController::class, 'edit']);
    Route::put('settings/update', [SettingAuthorController::class, 'update']);
    Route::put('password/update', [SettingAuthorController::class, 'updatePassword']);
    Route::get('comments', [AuthorComment::class, 'index']);
    Route::delete('comments/destroy/{id}', [AuthorComment::class, 'destroy']);
    
});
// website
Route::get('/', [WebsiteController::class, 'index']);
Route::post('/subscribers/store', [WebsiteController::class, 'subscriber']);
Route::get('/posts/search', [WebsiteController::class, 'search']);
Route::post('favorite/{post}/add', [FavoriteController::class, 'add']);
Route::get('posts', [FrontendPostController::class, 'index']);
Route::get('post/{slug}', [FrontendPostController::class, 'show']);
Route::get('post/category/{slug}', [FrontendPostController::class, 'relatedTOCategory']);
Route::get('post/tag/{slug}', [FrontendPostController::class, 'relatedTOTag']);
Route::post('comments/{post}', [CommentController::class, 'store']);
Route::get('profile/{username}', [ProfileController::class, 'index']);

View::composer('layouts.website',function ($view) {
    $categories = App\Models\Category::all();
    $view->with('categories',$categories);
});

require __DIR__.'/auth.php';
