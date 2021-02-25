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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/rate', [App\Http\Controllers\RateController::class, 'index'])->name('rate');
Route::post('/rate-store', [App\Http\Controllers\RateController::class, 'store'])->name('rate.store');
Route::post('/rate-update', [App\Http\Controllers\RateController::class, 'update'])->name('rate.update');

Route::post('/parking-in', [App\Http\Controllers\ParkingController::class, 'parkIn'])->name('park.in');
Route::get('/out', [App\Http\Controllers\ParkingController::class, 'out'])->name('out');
Route::post('/parking-out', [App\Http\Controllers\ParkingController::class, 'parkOut'])->name('park.out');
Route::get('/report', [App\Http\Controllers\ReportController::class, 'report'])->name('report');
Route::get('/report-action', [App\Http\Controllers\ReportController::class, 'actionReport'])->name('action.report');
Route::get('/export', [App\Http\Controllers\ReportController::class, 'export'])->name('export');
