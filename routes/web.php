<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users-list');

Route::prefix('user')->group(function () {
    Route::post('/save', [App\Http\Controllers\UserController::class, 'store']);
    Route::get('/get', [App\Http\Controllers\UserController::class, 'get'])->name('get-user');
    Route::get('/detail', [App\Http\Controllers\UserController::class, 'detail'])->name('user-detail');
    Route::get('/delete', [App\Http\Controllers\UserController::class, 'destroy']);
});
