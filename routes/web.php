<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartIdController;

Route::get('/', [SmartIdController::class, 'home'])->name('home');
//overide filament auth
Route::get('/login', fn() => redirect('/login-smartid'));
Route::get('/login-smartid', [SmartIdController::class, 'redirectToSmartId'])->name('login.smartid');

//route biasane
Route::get('/callback', [SmartIdController::class, 'callback']);
Route::get('/client-home', [SmartIdController::class, 'clientHome'])->name('client.home');
Route::post('/logout-client', [SmartIdController::class, 'logoutClient'])->name('logout.client');
Route::get('/logout-all', [SmartIdController::class, 'logoutAll'])->name('logout-all');
