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


    // Route::group(['middleware' => ['permission:publish articles|edit articles']], function () {
    // ROLES
    Route::get("users/roles", [App\Http\Controllers\API\RoleController::class, 'index']);
    Route::post("users/roles", [App\Http\Controllers\API\RoleController::class, 'store']);
    Route::get("users/roles/{id}/permissions", [App\Http\Controllers\API\RoleController::class, 'getPermissions']);
    Route::post("users/roles/{id}/permissions", [App\Http\Controllers\API\RoleController::class, 'syncPermissions']);
    Route::get("users/roles/{id}/users", [App\Http\Controllers\API\RoleController::class, 'getUsers']);

    // PERMISSIONS
    Route::get("users/permissions", [App\Http\Controllers\API\PermissionController::class, 'index']);


    // USER ACCOUNTS
    Route::get("users/{id}/roles", [App\Http\Controllers\API\UserController::class, "getRoles"]);
    // Route::get("users/{id}/permissions", [App\Http\Controllers\API\UserController::class, "getPermissions"]);
    Route::post("users/{id}/roles", [App\Http\Controllers\API\UserController::class, "syncRoles"]);


    Route::middleware(["permission:view users"])->group(function () {
        Route::apiResource("users", App\Http\Controllers\API\UserController::class)
            ->parameters(['users' => 'id'])
            ->missing(function (Request $request) {
                return  response()->json(["message" => "Account not found"], 404);
            });
    });
});
