<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiGeneratorController;
use App\Http\Controllers\UserController;

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

require __DIR__.'/auth.php';

Auth::routes();

Route::redirect('/', '/login');
Route::resource('users', \App\Http\Controllers\UserController::class)
    ->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::controller(ApiController::class)->group(function () {
        Route::get('/api', 'index');
        Route::get('/api/create', 'create');
        Route::post('/api/store', 'store');
    });

     Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::get('/users/edit/{id}', 'edit');
        Route::post('/users/update', 'update');
        Route::post('/users/store', 'store');
    });

});

Route::controller(ApiGeneratorController::class)->group(function () {
    Route::get('/{model}/{id}', 'show');
});
