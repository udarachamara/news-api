<?php

use Illuminate\Support\Facades\Route;

//middleware(['access_role:Author|Admin|Super Admin|Viewer']);

Route::prefix('/user')->group(function () {
    Route::post('/auth', [App\Http\Controllers\api\v1\LoginController::class, 'auth'])->middleware('cors');
    Route::post('/register', [App\Http\Controllers\api\v1\LoginController::class, 'register'])->middleware('cors');
    Route::get('/authUser', [App\Http\Controllers\api\v1\LoginController::class, 'authUser'])->middleware(['cors', 'user_accessible']);
    Route::get('/{id}', [App\Http\Controllers\api\v1\LoginController::class, 'getUserById'])->middleware(['cors', 'user_accessible']);
});

Route::prefix('/{lang}/tags')->group(function () {
    Route::get('/', [App\Http\Controllers\api\v1\TagController::class, 'index'])->middleware('cors');
    Route::post('/', [App\Http\Controllers\api\v1\TagController::class, 'store'])->middleware(['cors', 'access_role:Admin|Super Admin']);
    Route::get('/{tag}', [App\Http\Controllers\api\v1\TagController::class, 'show'])->middleware('cors');
    Route::put('/{tag}', [App\Http\Controllers\api\v1\TagController::class, 'update'])->middleware(['cors', 'access_role:Admin|Super Admin']);
    Route::delete('/{tag}', [App\Http\Controllers\api\v1\TagController::class, 'destroy'])->middleware(['cors', 'access_role:Admin|Super Admin']);
});

Route::prefix('/{lang}/posts')->group(function () {
    Route::get('/', [App\Http\Controllers\api\v1\PostController::class, 'index'])->middleware('cors');
    Route::post('/', [App\Http\Controllers\api\v1\PostController::class, 'store'])->middleware(['cors', 'access_role:Author']);
    Route::get('/{post}', [App\Http\Controllers\api\v1\PostController::class, 'show'])->middleware('cors');
    Route::put('/{post}', [App\Http\Controllers\api\v1\PostController::class, 'update'])->middleware(['cors', 'access_role:Author']);
    Route::delete('/{post}', [App\Http\Controllers\api\v1\PostController::class, 'destroy'])->middleware(['cors', 'access_role:Admin|Super Admin|Author']);
});
