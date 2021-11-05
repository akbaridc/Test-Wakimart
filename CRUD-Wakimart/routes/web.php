<?php

use App\Http\Controllers\UserController;
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

Route::get('/getData', [UserController::class, 'getDataUser']);
Route::get('/', [UserController::class, 'index']);
Route::post('/', [UserController::class, 'store']);
Route::get('/show/{id}', [UserController::class, 'show']);
Route::get('/edit/{id}', [UserController::class, 'edit']);
Route::post('/update', [UserController::class, 'update']);
Route::delete('/delete/{id}', [UserController::class, 'delete']);
