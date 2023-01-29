<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);
Route::get('category',[AuthController::class,'categoryList'])->middleware('auth:sanctum');

// post
Route::get('allPostList',[PostController::class,'getAllPost']);
Route::post('post/search',[PostController::class,'postSearch']);
Route::post('post/details',[PostController::class,'postDetails']);

// category
Route::get('allCategory',[CategoryController::class,'getAllCategory']);
Route::post('category/search',[CategoryController::class,'categorySearch']);

// action log
Route::post('post/actionLog',[ActionLogController::class,'setActionLog']);
