<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::post('/siswa/create', [SiswaController::class, 'create']);
    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit']);
    Route::post('/siswa/{id}/update', [SiswaController::class, 'update']);
    Route::get('/siswa/{id}/delete', [SiswaController::class, 'delete']);
    Route::get('/siswa/{id}/profile', [SiswaController::class, 'profile']);
    Route::get('/siswa/export-excel', [SiswaController::class, 'exportExcel']);
    Route::get('/siswa/export-pdf', [SiswaController::class, 'exportPdf']);
    Route::get('/siswa/pdf', [SiswaController::class, 'pdf']);
    Route::post('/siswa/{id}/addnilai', [SiswaController::class, 'addnilai']);
    Route::get('/siswa/{id}/export-pdf-siswa', [SiswaController::class, 'exportSiswaPdf']);

    Route::prefix('mapel')->group(function () {
        Route::get('/', [MapelController::class, 'index']);
        Route::post('/create', [MapelController::class, 'create']);
        Route::get('/{id}/edit', [MapelController::class, 'edit']);
        Route::post('/{id}/update', [MapelController::class, 'update']);
        Route::get('/{id}/delete', [MapelController::class, 'delete']);
    });
});
