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

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/','/userCrud');
Route::get('/userCrud',[App\Http\Controllers\BaseController::class,'index'])->name('userCrud');
Route::get('user/list',[App\Http\Controllers\UserController::class,'index'])->name('userList');
Route::get('/user/create',[App\Http\Controllers\UserController::class,'createUser'])->name('createUser');
