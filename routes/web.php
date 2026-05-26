<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/screen-journal', [ScreeningController::class, 'index'])
    ->name('screen-journal');

Route::middleware(['auth'])->group(function () {

    Route::get('/screen-journal', [ScreeningController::class, 'index'])
        ->name('screen-journal.index');

    Route::get('/screen-journal/create', [ScreeningController::class, 'create'])
        ->name('screen-journal.create');

    Route::post('/screen-journal', [ScreeningController::class, 'store'])
        ->name('screen-journal.store');

    Route::get('/screen-journal/{journal}', [ScreeningController::class, 'show'])
        ->name('screen-journal.show');

    Route::delete('/screen-journal/{journal}', [ScreeningController::class, 'destroy'])
        ->name('screen-journal.destroy');

    Route::get('/results', [ScreeningController::class, 'results'])
        ->name('results.index');

    Route::get('/results/{journal}', [ScreeningController::class, 'resultShow'])
        ->name('results.show');

    Route::resource('countries', CountryController::class);

    Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
    Route::get('/countries/create', [CountryController::class, 'create'])->name('countries.create');
    Route::post('/countries', [CountryController::class, 'store'])->name('countries.store');
    Route::get('/countries/{country}', [CountryController::class, 'show'])->name('countries.show');
    Route::delete('/countries/{country}', [CountryController::class, 'destroy'])
        ->name('countries.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    Route::get('/reports', [ScreeningController::class, 'reports'])
        ->name('reports.index');

    Route::get('/reports/country-analysis', [ScreeningController::class, 'countryReport'])
        ->name('reports.country');

    Route::get('/reports/screening-trend', [ScreeningController::class, 'trendReport'])
        ->name('reports.trend');

    Route::get('/reports/screening-trend/{year}/{month}', [ScreeningController::class, 'trendMonth'])
        ->name('reports.trend.month');

    Route::get('/reports/risk-distribution', [ScreeningController::class, 'riskDistribution'])
        ->name('reports.risk');

    Route::get('/reports/user-activity', [ScreeningController::class, 'userActivity'])
        ->name('reports.user-activity');

    Route::get('/reports/user-activity/{user}', [ScreeningController::class, 'userActivityShow'])
        ->name('reports.user-activity.show');

    Route::get('/results/{journal}/pdf', [ScreeningController::class, 'exportPdf'])
        ->name('results.pdf');

});



require __DIR__.'/auth.php';
