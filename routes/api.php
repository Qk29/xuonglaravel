<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::prefix("product")->group(function(){
        // http://projectxuongdb.test/api/product
        Route::get('/',[ProductController::class, 'index']);
        // http://projectxuongdb.test/api/product/1
        Route::get('/{id}',[ProductController::class, 'show']);
        // http://projectxuongdb.test/api/product/add
        Route::post('add',[ProductController::class, 'add']);
        // http://projectxuongdb.test/api/product/update/1
        Route::put('update/{id}',[ProductController::class, 'update']);
        // http://projectxuongdb.test/api/product/delete/1
        Route::delete('delete/{id}',[ProductController::class, 'delete']);
    });
    
   
});



?>