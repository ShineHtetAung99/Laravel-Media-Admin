<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    // admin
    Route::get('dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class,'updateAdminAccount'])->name('admin#update');
    Route::get('admin/changePassword',[ProfileController::class,'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('admin/changePassword',[ProfileController::class,'changePassword'])->name('admin#changePassword');

    // admin list
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/delete/{id}',[ListController::class,'deleteAccount'])->name('admin#deleteAccount');

    // category
    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::get('category/create',[CategoryController::class,'createPage'])->name('admin#createCategoryPage');
    Route::post('category/create',[CategoryController::class,'create'])->name('admin#createCategory');
    Route::get('category/delete/{id}',[CategoryController::class,'delete'])->name('admin#deleteCategory');
    Route::get('category/edit/{id}',[CategoryController::class,'edit'])->name('admin#editCategory');
    Route::post('category/update/{id}',[CategoryController::class,'update'])->name('admin#updateCategory');

    // post
    Route::get('post',[PostController::class,'index'])->name('admin#post');
    Route::get('post/create',[PostController::class,'createPage'])->name('admin#createPostPage');
    Route::post('post/create',[PostController::class,'create'])->name('admin#createPost');
    Route::get('post/delete/{id}',[PostController::class,'delete'])->name('admin#deletePost');
    Route::get('post/edit/{id}',[PostController::class,'edit'])->name('admin#editPost');
    Route::post('post/update/{id}',[PostController::class,'update'])->name('admin#updatePost');

    // trend post
    Route::get('trendPost',[TrendPostController::class,'index'])->name('admin#trendPost');
    Route::get('trendPost/details/{id}',[TrendPostController::class,'details'])->name('admin#detailsTrendPost');
});
