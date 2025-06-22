<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\panel\CommentController;
use App\Http\Controllers\panel\PanelController;
use App\Http\Controllers\panel\PostController;
use App\Http\Controllers\panel\TagController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [AuthController::class, 'index'])->name('register-form');
        Route::post('/register', [AuthController::class, 'register'])->name('register');

        Route::get('/login', [AuthController::class, 'loginView'])->name('login-form');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
    });

    Route::group(['middleware' => 'auth', 'prefix' => '/panel'], function () {
        Route::get('/', [PanelController::class, 'index'])->name('panel-index');

        Route::group(['prefix' => '/tag'], function () {
            Route::get('/', [TagController::class, 'index'])->name('tag-index');
        });

        Route::get('/post', [PostController::class, 'index'])->name('post.index');
        Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
        Route::get('/{post}/post', [PostController::class, 'show'])->name('post.show');
        Route::post('/post', [PostController::class, 'store'])->name('post.store');
        Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::put('/post/{post}', [PostController::class, 'update'])->name('post.update');
        Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

        Route::resource('comment', CommentController::class);
    });

    Route::group(['prefix' => '/chat-room', 'middleware' => 'auth'], function () {
        Route::get('/', [ChatRoomController::class, 'index']);
        Route::post('/store', [ChatRoomController::class, 'store'])->name('chat-room.store');
        Route::get("/{chatRoom}", [ChatRoomController::class, 'enter'])->name('chat-room.enter');
        Route::post('/public-message/send', [ChatController::class, 'publicMessage'])->name('chat-room.public.message');
    });

    Route::group(['prefix' => '/chat', 'middleware' => 'auth'], function () {
        Route::post('/public-chat/send', [ChatController::class, 'publicChat'])->name('chat.public');
        Route::post('/private-chat/send', [ChatController::class, 'privateChat'])->name('chat.private');
    });

    Route::get('/posts', [\App\Http\Controllers\site\PostController::class, 'posts']);
    Route::get('/{post}/post', [\App\Http\Controllers\site\PostController::class, 'show'])->name('site.post.show');
    Route::post('/{post}/comment', [\App\Http\Controllers\site\PostController::class, 'storeComment'])->middleware('auth')->name('site.comment.store');
});

