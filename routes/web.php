<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlurpengolahanController;
use App\Http\Controllers\AluredcodController;
use App\Http\Controllers\AlurentriController;
use App\Http\Controllers\DashboardController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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


Route::get('/', [DashboardController::class, 'all']);
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);


Route::get('alurpengolahan/{alurpengolahan}/editselfrekap', [AlurpengolahanController::class, 'editselfrekap'])->name('alurpengolahan.editselfrekap');
Route::put('alurpengolahan/{alurpengolahan}/updateselfrekap', [AlurpengolahanController::class, 'updateselfrekap'])->name('alurpengolahan.updateselfrekap');
Route::get('alurpengolahan/selfrekap', [AlurpengolahanController::class, 'selfrekap'])->name('alurpengolahan.selfrekap');
Route::resource('alurpengolahan', AlurpengolahanController::class);


Route::get('aluredcod/selfrekap', [AluredcodController::class, 'selfrekap'])->name('aluredcod.selfrekap');
Route::get('aluredcod/{aluredcod}/editselfrekap', [AluredcodController::class, 'editselfrekap'])->name('aluredcod.editselfrekap');
Route::put('aluredcod/{aluredcod}/updateselfrekap', [AluredcodController::class, 'updateselfrekap'])->name('aluredcod.updateselfrekap');
Route::resource('aluredcod', AluredcodController::class);


Route::get('alurentri/selfrekap', [AlurentriController::class, 'selfrekap'])->name('alurentri.selfrekap');
Route::get('alurentri/{alurentri}/editselfrekap', [AlurentriController::class, 'editselfrekap'])->name('alurentri.editselfrekap');
Route::put('alurentri/{alurentri}/updateselfrekap', [AlurentriController::class, 'updateselfrekap'])->name('alurentri.updateselfrekap');
Route::resource('alurentri', AlurentriController::class);


Route::get('dashboard/all', [DashboardController::class, 'all'])->name('dashboard.all');
Route::get('dashboard/edcod', [DashboardController::class, 'edcod'])->name('dashboard.edcod');
Route::get('dashboard/entri', [DashboardController::class, 'entri'])->name('dashboard.entri');
Route::get('dashboard/kinerjapp', [DashboardController::class, 'kinerjapp'])->name('dashboard.kinerjapp');
Route::resource('dashboard', DashboardController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboards', function () {
        return view('dashboards');
    })->name('dashboard');
});
