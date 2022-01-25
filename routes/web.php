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
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\AntrianServiceController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\ServiceMasukAssetController;
use App\Http\Controllers\Danliris_Permintaan_Controller;
use App\Http\Controllers\Efrata_Permintaan_Controller;
use App\Http\Controllers\AG_Permintaan_Controller;
use App\Http\Controllers\DanlirisBudgetController;
use App\Http\Controllers\EfrataBudgetController;
use App\Http\Controllers\AGBudgetController;

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

//supplier route
Route::get('supplier/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::resource('supplier', SupplierController::class)->except(['show']);

//permintaan route
Route::get('permintaan/{id}/edit', [PermintaanController::class, 'edit'])->name('permintaan.edit');
Route::resource('permintaan', PermintaanController::class)->except(['show']);
Route::get('getDanliris', [PermintaanController::class, 'getDanliris'])->name('permintaan.getDanliris');
Route::get('getEfrata', [PermintaanController::class, 'getEfrata'])->name('permintaan.getEfrata');
Route::get('permintaan/{id}/edit', [Danliris_Permintaan_Controller::class, 'edit'])->name('permintaan.edit');
Route::resource('danliris_permintaan', Danliris_Permintaan_Controller::class)->except(['show']);
Route::get('permintaan/{id}/edit', [Efrata_Permintaan_Controller::class, 'edit'])->name('permintaan.edit');
Route::resource('efrata_permintaan', Efrata_Permintaan_Controller::class)->except(['show']);
Route::get('permintaan/{id}/edit', [AG_Permintaan_Controller::class, 'edit'])->name('permintaan.edit');
Route::resource('ag_permintaan', AG_Permintaan_Controller::class)->except(['show']);

//budget route
Route::get('budget/{id}/edit', [BudgetController::class, 'edit'])->name('budget.edit');
Route::resource('budget', BudgetController::class)->except(['show']);

Route::get('danliris_budget/{id}/edit', [DanlirisBudgetController::class, 'edit'])->name('budget.edit');
route::resource('danliris_budget', DanlirisBudgetController::class)->except(['show']);

Route::get('efrata_budget/{id}/edit', [EfrataBudgetController::class, 'edit'])->name('efrata.edit');
route::resource('efrata_budget', EfrataBudgetController::class)->except(['show']);

Route::get('ag_budget/{id}/edit', [AGBudgetController::class, 'edit'])->name('budget.edit');
route::resource('ag_budget', AGBudgetController::class)->except(['show']);

//antrianservice route
Route::get('antrianservice/{id}/edit', [AntrianServiceController::class, 'edit'])->name('antranservice.edit');
Route::resource('antrianservice', AntrianServiceController::class)->except(['show']);
//pemasukan route
Route::get('pemasukan/{id}/edit', [PemasukanController::class, 'edit'])->name('pemasukan.edit');
Route::resource('pemasukan', PemasukanController::class)->except(['show']);

//servicemasukasset route
Route::get('servicemasukasset/{id}/edit', [ServiceMasukAssetController::class, 'edit'])->name('servicemasukasset.edit');
Route::resource('servicemasukasset', ServiceMasukAssetController::class)->except(['show']);

