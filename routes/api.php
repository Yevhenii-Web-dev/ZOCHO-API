<?php


use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\DealController;
use App\Http\Controllers\Api\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::post('/generate', [WelcomeController::class, 'generateAccessToken'])->name('generate.generateAccessToken');

Route::resource('/contacts', ContactController::class)->except('show','update','edit');
Route::resource('/deals', DealController::class)->except('show','update','edit');

Route::get('/contacts/{contact}/deals/create', [ContactController::class, 'createDealInContact'])->name('contacts.createDealInContact');
Route::post('/contacts/{contact}/deals', [ContactController::class, 'storeDealInContact'])->name('contacts.storeDealInContact');

