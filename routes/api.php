<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post("login", [App\Http\Controllers\Auth\LoginController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get("logout", [App\Http\Controllers\Auth\LoginController::class, 'logout']);

    // USER ACCOUNTS
    Route::apiResource("users", App\Http\Controllers\API\UserController::class)
        ->parameters([
            'users' => 'id'
        ])
        ->missing(function (Request $request) {
            return  response()->json(["message" => "Account not found"], 404);
        });

    // ROLES
    Route::apiResource("userroles", App\Http\Controllers\API\RoleController::class)
        ->parameters([
            'userroles' => 'id'
        ])
        ->missing(function (Request $request) {
            return  response()->json(["message" => "Account not found"], 404);
        });
});
