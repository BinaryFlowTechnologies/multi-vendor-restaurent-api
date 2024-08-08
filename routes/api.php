<?php

use App\Http\Controllers\API\Admin\ACL\PermissionController;
use App\Http\Controllers\API\Admin\ACL\RoleController;
use App\Http\Controllers\API\Admin\ACL\UserController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [LoginController::class, 'logout']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    /*------------------- ACL -------------------*/
    Route::prefix('acl')->group(function () {
        Route::apiResource('users', UserController::class)->except(['create', 'show']);
        Route::apiResource('roles', RoleController::class)->except(['create', 'show']);
        Route::apiResource('permissions', PermissionController::class)->except(['create', 'show']);


        Route::get('permissions/all', [PermissionController::class, 'all']);
        Route::get('roles/all', [RoleController::class, 'all']);
    });
    /*------------------- ACL -------------------*/
});
