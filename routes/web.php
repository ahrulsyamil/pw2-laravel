<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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
    return view('welcome');
});

Route::prefix('/todos')->group(function () {
    Route::get('/', [TodoController::class, 'index'])->name('todos.index');
    Route::post('/', [TodoController::class, 'store'])->name("todos.store");
    Route::put('/{id}', [TodoController::class, 'update'])->name("todos.update");
    Route::delete('/{id}', [TodoController::class, 'destroy'])->name("todos.destroy");
});
