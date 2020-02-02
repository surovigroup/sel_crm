<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TechplatoonController;
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
    return redirect('admin/login');
});

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        //Statuses
        Route::get('/statuses', [StatusController::class, 'index']);
        Route::get('/statuses/create', [StatusController::class, 'create']);
        Route::post('/statuses', [StatusController::class, 'store']);
        Route::get('/statuses/{status}/edit', [StatusController::class, 'edit']);
        Route::patch('/statuses/{status}', [StatusController::class, 'update']);

        //Statuses
        Route::get('/sources', [SourceController::class, 'index']);
        Route::get('/sources/create', [SourceController::class, 'create']);
        Route::post('/sources', [SourceController::class, 'store']);
        Route::get('/sources/{source}/edit', [SourceController::class, 'edit']);
        Route::patch('/sources/{source}', [SourceController::class, 'update']);

        //Leads
        Route::get('/leads', [LeadController::class, 'index']);
        Route::get('/leads/datatable', [LeadController::class, 'datatable'])->name('leads.datatable');
        Route::get('/leads/create', [LeadController::class, 'create']);
        Route::post('/leads', [LeadController::class, 'store']);
        Route::get('/leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
        Route::get('/leads/{lead}/edit', [LeadController::class, 'edit'])->name('leads.edit');
        Route::patch('/leads/{lead}', [LeadController::class, 'update']);
        Route::put('/leads/{lead}', [LeadController::class, 'updateStatus']);
    });

    Route::group(['middleware' => ['admin']], function () {
        Route::get('techplatoon/brands/{brand}', [TechplatoonController::class, 'brand'])->name('techplatoon.brand');
    });
    
});