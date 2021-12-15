<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddAdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\UnitController;
use App\Models\Location;

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
    return view('login');
});

// test menu
Route::get('/menu/testmenu', [Controller::class, 'test']);

//login route
Route::get('login', [AuthController::class, 'index'])->name('auth.login');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('auth.proses_login');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:superadmin']], function() {
        Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    });

    Route::group(['middleware' => ['cek_login:admin']], function() {
        Route::get('dashboard', [AdminController::class, 'adminIndex'])->name('dashboard');
    });
});

//logout route
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

//tambah admin route
Route::get('index', [AddAdminController::class, 'index'])->name('admin.index');
Route::get('addAdmin/{id}/edit', [AddAdminController::class, 'edit'])->name('addAdmin.edit');
Route::resource('addAdmin', AddAdminController::class);

//company route
Route::get('company/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
Route::resource('company', CompanyController::class)->except(['show']);

//category route
Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::resource('category', CategoryController::class)->except(['show']);

//location route
Route::get('location/{id}/edit', [LocationController::class, 'edit'])->name('location.edit');
Route::resource('location', LocationController::class)->except(['show']);

//division route
Route::get('division/{id}/edit', [DivisionController::class, 'edit'])->name('division.edit');
Route::resource('division', DivisionController::class)->except(['show']);

//manufacture route
Route::get('manufacture/{id}/edit', [ManufactureController::class, 'edit'])->name('manufacture.edit');
Route::resource('manufacture', ManufactureController::class)->except(['show']);

//asset route
Route::get('asset/{id}/edit', [AssetController::class, 'edit'])->name('asset.edit');
Route::resource('asset', AssetController::class);

//unit route
Route::get('unit/{id}/edit', [UnitController::class, 'edit'])->name('unit.edit');
Route::resource('unit', UnitController::class)->except(['show']);

