<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PurchaseController;
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
Route::get("order/orderInvoice/{id}", [OrderController::class,"invoice"]);
Route::get("customer", [OrderController::class,"OrderData"]);
Route::post("order/react_order_save", [OrderController::class,"react_order_save"]);




Route::get("purchase",[PurchaseController::class,"index"]);
Route::get("supplier",[PurchaseController::class,"purchaseData"]);
Route::post("purchase/react_purchase_save",[PurchaseController::class,"react_purchase_save"]);