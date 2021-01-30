<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AffiliationsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\UsersController;
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
    Route::resource('administration/tag/utilisateur', UsersController::class);
    Route::get('administration/users&get&data/now', [UsersController::class, 'getUsers']);
    Route::get('administration/members&get&data/now', [MembersController::class, 'getMembers']);
});


Route::get('/test/mail', [MailController::class, 'index'])->name('mail');



Route::get('/profil', function () {
    return view('layouts.home');
});

Route::post('login/uvar&user&get&auth', [LoginController::class, 'login']);
Route::post('/Uvar/membre/affiliation/ID={id}', [AffiliationsController::class, 'affiliate']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
