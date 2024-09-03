<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\PublicReports;
use App\Livewire\Report\CreateReport as LWCreateReport;
use App\Livewire\Report\EditReport as LWEditReport;
use App\Livewire\Report\ListReports as LWListReports;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/public-reports', PublicReports::class)->name('public.reports');

// Home Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// wrap with guest Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});
Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Report Routes
    Route::get('/reports/create', LWCreateReport::class)->name('create.report');
    Route::get('/reports/{reportId}/edit', LWEditReport::class)->name('edit.report');
    Route::get('/reports', LWListReports::class)->name('reports.index');
});

Route::get('/reports/{slug}', [ReportController::class, 'show'])->name('reports.show');