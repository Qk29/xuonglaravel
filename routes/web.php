<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
Route::group(['prefix' => 'admin','as' => 'admin.'], function () {
    Route::get('login', function () {
        return view('admin.login-page.login');
    })->name('login');
});

Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('/', [ProductController::class,'index'])->name('index');
    
    // Route::get('/create', function () {
    //     return view('products.create');
    // })->name('create');
    
    // Route::get('/{id}', function ($id) {
    //     return view('products.show');
    // })->name('show');
    
    // Route::get('/{id}/edit', function ($id) {
    //     return view('products.edit');
    // })->name('edit');
});

Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
    Route::get('/', [CategoryController::class,'index'])->name('index');
    
    // Route::get('/create', function () {
    //     return view('products.create');
    // })->name('create');
    
    // Route::get('/{id}', function ($id) {
    //     return view('products.show');
    // })->name('show');
    
    // Route::get('/{id}/edit', function ($id) {
    //     return view('products.edit');
    // })->name('edit');
});

Route::group(['prefix'=>'users','as'=>'users.'],function(){
    Route::get('/',[UserController::class,'index'])->name('index');
});