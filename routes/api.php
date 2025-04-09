<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;



Route::prefix("product")->group(function(){
    // http://projectxuongdb.test/api/product
    Route::get('/',[ProductController::class, 'index']);
    Route::get('/{id}',[ProductController::class, 'show']);
    Route::post('add',[ProductController::class, 'add']);
    Route::put('update/{id}',[ProductController::class, 'update']);
    Route::delete('delete/{id}',[ProductController::class, 'delete']);
})

// Lap 07 CRUD product (image) bằng api 




?>