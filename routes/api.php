<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RoleController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::post('auth/login',[AuthController::class,'login']);

// Route::post('auth/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

Route::post('/auth/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::get("role", [RoleController::class,"index"]);
Route::get("role", [RoleController::class,"index"]);
Route::post("role/save", [RoleController::class,"store"]);
Route::get("role/find/{id}", [RoleController::class,"show"]);
Route::put("role/update", [RoleController::class,"update"]);
Route::delete("role/delete", [RoleController::class,"destroy"]);





Route::get("order", [OrderController::class,"index"]);
Route::get("order", [OrderController::class,"index"]);
Route::get("customer", [OrderController::class,"OrderData"]);
