<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessagesController;

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

Route::get('login',[UserController::class,'login'])->name('login');
Route::get('register',[UserController::class,'register']);
Route::post('auth',[UserController::class,'auth'])->name('auth');
Route::post('store',[UserController::class,'store'])->name('store');

Route::group(['Middleware'=>'auth'],function(){
    Route::get('home',[UserController::class,'home'])->name('home');
    Route::post('message/add',[MessagesController::class,'send'])->name('send');
    Route::get('messages/user/{id}',[MessagesController::class,'messages']);

});


