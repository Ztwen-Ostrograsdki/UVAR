<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MembersController;
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


Route::group(['prefix' => 'Uvar'], function() {
    Route::resource('administration', AdminController::class);

    Route::resource('administration/tag/membres', MembersController::class);
});


Route::get('/profil', function () {
    return view('layouts.home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
