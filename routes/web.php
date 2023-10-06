<?php

use App\Http\Controllers\Dashboard\AssetController;
use App\Http\Controllers\Dashboard\CategoryAssetController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DivisionController;
use App\Http\Controllers\Dashboard\LoanController;
use App\Http\Controllers\dashboard\ReturnController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\VendorController;
use App\Http\Controllers\getGeoController;
use App\Http\Controllers\Location\CityController;
use App\Http\Controllers\Location\DistrictController;
use App\Http\Controllers\Location\VillageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
    return Redirect::route('dashboard');
});

Route::get('/contact-team', function(){
    return view('dashboard.contact-our-team');
})->name('contact-team');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/update-password', [ProfileController::class, 'update_password'])->name('update.password');
});

Route::middleware(['auth', 'verified',])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('divisions', DivisionController::class);
    Route::resource('users', UserController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('asets', AssetController::class);
    Route::resource('loans', LoanController::class);
    Route::resource('returns', ReturnController::class);

    //category
    Route::get('/category', [CategoryAssetController::class, 'index'])->name('index_category');
    Route::post('/category', [CategoryAssetController::class, 'store'])->name('store_category');
    Route::put('/category/{id}', [CategoryAssetController::class, 'update'])->name('update_category');
    Route::delete('/category/{id}', [CategoryAssetController::class, 'destroy'])->name('delete_category');
});


// Indonesia location
Route::get('/cities/{province}', [getGeoController::class, 'getCityByProvince']);
Route::get('/districts/{city}', [getGeoController::class, 'getDistrictByCity']);
Route::get('/villages/{district}', [getGeoController::class, 'getVillageByDistrict']);


require __DIR__.'/auth.php';
