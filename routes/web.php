<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Personal\CommentController;
use App\Http\Controllers\Personal\LikeController;
use App\Http\Controllers\Personal\LikedController;
use App\Http\Controllers\PersonalController;
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
//Main
Route::get('/', [IndexController::class, 'index'])->name('main.index');
//Posts
Route::group(['namespace' => 'Posts', 'prefix' => 'posts'], function () {
    Route::get('/', [App\Http\Controllers\Main\PostController::class, 'index'])->name('post.index');
    Route::group(['namespace' => 'Post', 'prefix' => '/{post}'], function(){
        Route::get('/', [App\Http\Controllers\Main\PostController::class, 'show'])->name('post.show');
        Route::post('/comments',[CommentController::class, 'store'])->name('post.comment.store');
        Route::post('/likes',[LikeController::class, 'index'])->name('post.like');
    });
});

//Personal
Route::group(['namespace' => 'Personal', 'prefix' => 'personal', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [PersonalController::class, 'index'])->name('personal.main.index');
    //Liked
    Route::group(['namespace' => 'Liked', 'prefix' => 'liked'], function () {
        Route::get('/', [LikedController::class, 'index'])->name('personal.liked.index');
        Route::delete('/{post}', [LikedController::class, 'destroy'])->name('personal.liked.delete');
    });
    //Comments
    Route::group(['namespace' => 'Personal', 'prefix' => 'comment',], function () {
        Route::get('/', [CommentController::class, 'index'])->name('personal.comment.index');
    });
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function () {
    //Admin
    Route::get('/', [AdminController::class, 'index'])->name('admin.main.index');
    //Categories
    Route::group(['namespace' => 'Categories', 'prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('admin.category.show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.category.delete');
    });
    //Tags
    Route::group(['namespace' => 'Tags', 'prefix' => 'tags'], function () {
        Route::get('/', [TagController::class, 'index'])->name('admin.tag.index');
        Route::get('/create', [TagController::class, 'create'])->name('tag.create');
        Route::post('/', [TagController::class, 'store'])->name('admin.tag.store');
        Route::get('/{tag}', [TagController::class, 'show'])->name('admin.tag.show');
        Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('admin.tag.edit');
        Route::patch('/{tag}', [TagController::class, 'update'])->name('admin.tag.update');
        Route::delete('/{tag}', [TagController::class, 'destroy'])->name('admin.tag.delete');

    });
    //Posts
    Route::group(['namespace' => 'Posts', 'prefix' => 'posts'], function () {
        Route::get('/', [PostController::class, 'index'])->name('admin.post.index');
        Route::get('/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/', [PostController::class, 'store'])->name('admin.post.store');
        Route::get('/{post}', [PostController::class, 'show'])->name('admin.post.show');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('admin.post.edit');
        Route::patch('/{post}', [PostController::class, 'update'])->name('admin.post.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('admin.post.delete');

    });
    //Users
    Route::group(['namespace' => 'Users', 'prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('admin.user.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::patch('/{user}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.user.delete');
    });
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
