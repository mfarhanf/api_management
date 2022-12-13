<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiGeneratorController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::controller(ApiController::class)->group(function () {
        Route::get('/api', 'index');
        Route::get('/api/create', 'create');
        Route::post('/api/store', 'store');
    });
});

Route::controller(ApiGeneratorController::class)->group(function () {
    Route::get('/{model}/{id}', 'show');
});
