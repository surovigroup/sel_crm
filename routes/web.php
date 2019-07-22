<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
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

Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminLoginController::class, 'showLoginForm']);
    Route::post('/login', [AdminLoginController::class, 'login']);

    Route::group(['middleware' => ['admin','permission:access_admin_dashboard']], function () {

        Route::post('/logout', [AdminLoginController::class, 'logout']);
        
        Route::get('/dashboard', [DashboardController::class, 'index']);

        //Users
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/create', [UserController::class, 'create']);
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::get('/users/{user}/edit', [UserController::class, 'edit']);
        Route::patch('/users/{user}', [UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);
        Route::get('/users/{user}/restore', [UserController::class, 'restore']);

        //Permissions
        Route::get('/permissions', [PermissionController::class, 'index']);
        Route::get('/permissions/create', [PermissionController::class, 'create']);
        Route::post('/permissions', [PermissionController::class, 'store']);

        //Roles
        Route::get('/roles', [RoleController::class, 'index']);
        Route::get('/roles/create', [RoleController::class, 'create']);
        Route::post('/roles', [RoleController::class, 'store']);
        Route::get('/roles/{role}', [RoleController::class, 'show']);
        Route::get('/roles/{role}/edit', [RoleController::class, 'edit']);
        Route::patch('/roles/{role}', [RoleController::class, 'update']);

    });

    Route::group(['middleware' => ['admin']], function () {
        //Statuses
        Route::get('/statuses', [StatusController::class, 'index']);
        Route::get('/statuses/create', [StatusController::class, 'create']);
        Route::post('/statuses', [StatusController::class, 'store']);

        //Leads
        Route::get('/leads', [LeadController::class, 'index']);
        Route::get('/leads/create', [LeadController::class, 'create']);
        Route::post('/leads', [LeadController::class, 'store']);
    });
    
});