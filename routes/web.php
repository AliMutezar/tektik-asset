<?php

use App\Http\Controllers\Dashboard\AssetController;
use App\Http\Controllers\Dashboard\DivisionController;
use App\Http\Controllers\Dashboard\LoanController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\VendorController;
use App\Http\Controllers\Location\CityController;
use App\Http\Controllers\Location\DistrictController;
use App\Http\Controllers\Location\VillageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function() {
    Route::resource('divisions', DivisionController::class);
    Route::resource('users', UserController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('assets', AssetController::class);
    Route::resource('loans', LoanController::class);
});

// Indonesia location
Route::get('/cities/{province}', [CityController::class, 'getCityByProvince']);
Route::get('/districts/{city}', [DistrictController::class, 'getDistrictByCity']);
Route::get('/villages/{district}', [VillageController::class, 'getVillageByDistrict']);


require __DIR__.'/auth.php';
