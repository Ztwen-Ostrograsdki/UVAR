<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AffiliationsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RequestsController;
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
})->name('home');


Route::group(['prefix' => 'Uvar'], function() {
    Route::resource('administration', AdminController::class);
    Route::put('administration/security/a=locked/user/u={user}', [AdminController::class, 'lockedUser']);
    Route::put('administration/security/a=dislocked/user/u={user}', [AdminController::class, 'dislockedUser']);
    Route::resource('administration/tag/membres', MembersController::class);
    Route::resource('administration/tag/demandes', RequestsController::class);
    Route::post('/systeme/requests/fecth&them', [RequestsController::class, 'getRequests']);
    Route::get('/membres/{id}',[ MembersController::class, 'index']);
    Route::resource('administration/tag/utilisateur', UsersController::class);
    Route::get('/utilisateur/{user}', [UsersController::class, 'show']);
    Route::post('/utilisateur/{user}', [UsersController::class, 'getUser']);
    Route::resource('administration/tag/produits', ProductController::class);
    Route::resource('administration/tag/actions', ActionController::class);
    Route::resource('administration/tag/categories', CategoryController::class);
    Route::get('administration/users&get&data/now', [UsersController::class, 'getUsers']);
    Route::get('administration/members&get&data/now', [MembersController::class, 'getMembers']);
    Route::get('administration/get&a&member/profil/id={id}', [MembersController::class, 'getMember']);
    Route::post('administration/actions&get&data/now', [ActionController::class, 'getActions']);
    Route::post('administration/get&action&data&/target/id={id}', [ActionController::class, 'getAction']);
    Route::get('administration/products&get&data/now', [ProductController::class, 'getProducts']);
    Route::get('administration/categories&get&data/now', [CategoryController::class, 'getCategories']);
    Route::post('/systeme/notify&system', [AffiliationsController::class, 'getNotifications']);



    Route::post('/administration/affiliations/manage', [AdminController::class, 'manageAffiliation']);
    Route::post('/myAffiliation/requests/manage/u={user}', [UsersController::class, 'manageMyAffiliation']);
    Route::post('/administration/demande/manage/type={type}/request={id}/response={r}', [AdminController::class, 'manageRequest']);
    Route::post('/administration/demande/manage/type={type}/request={id}/response={r}', [AdminController::class, 'manageRequest']);

    // Route::get('/administration/affiliations/manage/referer={referer}/referee={referee}/r={response}', [AdminController::class, 'manageAffiliationExternally']);

    Route::get('/Je&ne&reconnais&pas&cette&demande/affiliations/manage/referer={referer}/referee={referee}/token={token}/r={r}/key={key}/e={externe}', [UsersController::class, 'manageMyIncomingAffiliation']);
    Route::post('/Je&ne&reconnais&pas&cette&demande/affiliations/manage/referer={referer}/referee={referee}/token={token}/r={r}/key={key}/e={externe}', [UsersController::class, 'manageMyIncomingAffiliation']);

    Route::put('/demande/affiliations/manage/referer={referer}/referee={referee}', [UsersController::class, 'IAcceptedThatRequest']);


    Route::get('/administration/tag/notifications', [AffiliationsController::class, 'index']);
    Route::put('/administration/update/images/membres/{id}', [ImagesController::class, 'forMember']);
    Route::put('/administration/boutique/action/q=achat/a={action}/m={member}/t={total}', [MarketController::class, 'buyAction']);
});

    Route::group(['prefix' => 'boutique'], function(){
        Route::get('q=actions', [MarketController::class, 'index']);
        Route::post('q=actions', [MarketController::class, 'getAllActions']);
        Route::post('q=actions/length', [MarketController::class, 'getAllActionsOnlyAPart']);

        Route::get('q=articles', [MarketController::class, 'index']);
        Route::post('q=articles', [MarketController::class, 'getAllProducts']);
        // Route::post('q=articles/length', [MarketController::class, 'getAllActionsOnlyAPart']);

    });

Route::get('/profil', function () {
    return view('layouts.home');
});

Route::post('/login/uvar&user&get&auth', [LoginController::class, 'login']);
Route::post('/uvar/systeme/disconnect&user/now', [LoginController::class, 'logout']);
Route::get('/uvar/systeme', [LoginController::class, 'getConnected']);
Route::post('/uvar/systeme/token/auth', [PublicController::class, 'getToken']);
Route::post('/uvar/systeme/get&auth&user', [LoginController::class, 'getConnected']);
Route::post('/uvar/systeme/auth&get&auth&member', [LoginController::class, 'getUserMember']);
Route::post('/Uvar/membre/affiliation/ID={id}', [AffiliationsController::class, 'affiliate']);

Route::get('/mail', [App\Http\Controllers\MailController::class, 'index']);
Route::get('/UVAR/confirmation/id={id}/token={token}', [LoginController::class, 'confirm']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
