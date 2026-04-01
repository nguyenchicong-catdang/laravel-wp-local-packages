<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('wp-view::index');
});

Route::get('/category/{slug}', [\Ncc\Wp\Categories\CategoryController::class, 'show']);

Route::get('/post/{slug}', [\Ncc\Wp\Posts\PostController::class, 'show'])->name('post');