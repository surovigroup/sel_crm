<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Users
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}/edit', [UserController::class, 'edit']);
Route::patch('/users/{user}', [UserController::class, 'update']);

//Permissions
Route::get('/permissions', [PermissionController::class, 'index']);
Route::get('/permissions/create', [PermissionController::class, 'create']);
Route::post('/permissions', [PermissionController::class, 'store']);

//Roles
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/roles/create', [RoleController::class, 'create']);
Route::post('/roles', [RoleController::class, 'store']);
Route::get('/roles/{role}/edit', [RoleController::class, 'edit']);
Route::patch('/roles/{role}', [RoleController::class, 'update']);