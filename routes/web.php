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
use App\Http\Controllers\Danliris_Permintaan_Controller;
use App\Http\Controllers\Efrata_Permintaan_Controller;
use App\Http\Controllers\AG_Permintaan_Controller;
use App\Http\Controllers\DanlirisBudgetController;
use App\Http\Controllers\EfrataBudgetController;
use App\Http\Controllers\AGBudgetController;
use App\Http\Controllers\Danliris_Antrianservice_Controller;
use App\Http\Controllers\Efrata_Antrianservice_Controller;
use App\Http\Controllers\AG_Antrianservice_Controller;
use App\Http\Controllers\AG_Servicefinal_Controller;
use App\Http\Controllers\Danliris_Analysis_Controller;
use App\Http\Controllers\Danliris_Servicefinal_Controller;
use App\Http\Controllers\Efrata_Analysis_Controller;
use App\Http\Controllers\Efrata_Servicefinal_Controller;
use App\Http\Controllers\AG_Analysis_Controller;
use App\Http\Controllers\AG_Change_Email_User_Controller;
use App\Http\Controllers\AG_Change_Pc_User_Controller;
use App\Http\Controllers\AG_Change_Wifi_Controller;
use App\Http\Controllers\AG_Kalibrasi_Alat_Controller;
use App\Http\Controllers\AG_RBT_Controller;
use App\Http\Controllers\AG_Serah_Terima_Controller;
use App\Http\Controllers\AG_Server_Controller;
use App\Http\Controllers\AG_Service_Tidak_Tercapai_Controller;
use App\Http\Controllers\AG_Stocklist_Controller;
use App\Http\Controllers\AG_Temperature_Controller;
use App\Http\Controllers\AG_Ups_Controller;
use App\Http\Controllers\Change_Email_User_Controller;
use App\Http\Controllers\Change_Pc_User_Controller;
use App\Http\Controllers\Change_Wifi_Controller;
use App\Http\Controllers\Danliris_Change_Email_User_Controller;
use App\Http\Controllers\Danliris_Change_Pc_User_Controller;
use App\Http\Controllers\Danliris_Change_Wifi_Controller;
use App\Http\Controllers\Danliris_Kalibrasi_Alat_Controller;
use App\Http\Controllers\Danliris_RBT_Controller;
use App\Http\Controllers\Danliris_Serah_Terima_Controller;
use App\Http\Controllers\Danliris_Server_Controller;
use App\Http\Controllers\Danliris_Service_Tidak_Tercapai_Controller;
use App\Http\Controllers\Danliris_Stock_Controller;
use App\Http\Controllers\Danliris_Stocklist_Controller;
use App\Http\Controllers\Danliris_Temperature_Controller;
use App\Http\Controllers\Danliris_Tidaktercapai_Controller;
use App\Http\Controllers\Danliris_Ups_Controller;
use App\Http\Controllers\DL_Change_Email_User_Controller;
use App\Http\Controllers\Efrata_Change_Email_User_Controller;
use App\Http\Controllers\Efrata_Change_Pc_User_Controller;
use App\Http\Controllers\Efrata_Change_Wifi_Controller;
use App\Http\Controllers\Efrata_Kalibrasi_Alat_Controller;
use App\Http\Controllers\Efrata_RBT_Controller;
use App\Http\Controllers\Efrata_Serah_Terima_Controller;
use App\Http\Controllers\Efrata_Server_Controller;
use App\Http\Controllers\Efrata_Service_Tidak_Tercapai_Controller;
use App\Http\Controllers\Efrata_Stocklist_Controller;
use App\Http\Controllers\Efrata_Temperature_Controller;
use App\Http\Controllers\Efrata_Ups_Controller;

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
Route::get('antrianservice/{id}/edit', [AntrianServiceController::class, 'edit'])->name('antrianservice.edit');
Route::resource('antrianservice', AntrianServiceController::class)->except(['show']);

Route::get('danliris_antrianservice/{id}/edit', [Danliris_Antrianservice_Controller::class, 'edit'])->name('danliris_antrianservice.edit');
Route::get('danliris_antrianservice/{id}/edit1', [Danliris_Antrianservice_Controller::class, 'edit1'])->name('danliris_antrianservice.edit1');
Route::resource('danliris_antrianservice', Danliris_Antrianservice_Controller::class)->except(['show']);


Route::get('efrata_antrianservice/{id}/edit', [Efrata_Antrianservice_Controller::class, 'edit'])->name('efrata_antrianservice.edit');
Route::resource('efrata_antrianservice', Efrata_Antrianservice_Controller::class)->except(['show']);

Route::get('ag_antrianservice/{id}/edit', [AG_Antrianservice_Controller::class, 'edit'])->name('ag_antrianservice.edit');
Route::resource('ag_antrianservice', AG_Antrianservice_Controller::class)->except(['show']);

//pemasukan route
Route::get('pemasukan/{id}/edit', [PemasukanController::class, 'edit'])->name('pemasukan.edit');
Route::resource('pemasukan', PemasukanController::class)->except(['show']);

//history service route
Route::get('danliris_historyservice/{id}/edit', [Danliris_Servicefinal_Controller::class, 'edit'])->name('danliris_historyservice.edit');
Route::resource('danliris_historyservice', Danliris_Servicefinal_Controller::class)->except(['show']);

Route::get('efrata_historyservice/{id}/edit', [Efrata_Servicefinal_Controller::class, 'edit'])->name('efrata_historyservice.edit');
Route::resource('efrata_historyservice', Efrata_Servicefinal_Controller::class)->except(['show']);

Route::get('ag_historyservice/{id}/edit', [AG_Servicefinal_Controller::class, 'edit'])->name('ag_historyservice.edit');
Route::resource('ag_historyservice', AG_Servicefinal_Controller::class)->except(['show']);

//Service Tidak Tercapai
Route::resource('danliris_service_tidak_tercapai', Danliris_Service_Tidak_Tercapai_Controller::class);

// Route::get('efrata_service_tidak_tercapai', Efrata_Service_Tidak_Tercapai_Controller::class);

// Route::get('ag_service_tidak_tercapai', AG_Service_Tidak_Tercapai_Controller::class);

//analysis route
Route::resource('danliris_analysis', Danliris_Analysis_Controller::class)->except(['show']);
Route::resource('efrata_analysis', Efrata_Analysis_Controller::class)->except(['show']);
Route::resource('ag_analysis', AG_Analysis_Controller::class)->except(['show']);

//upload stock
Route::resource('danliris_stockopname', Danliris_Stocklist_Controller::class)->except(['show']);
Route::post('/danliris_stockopname/import', [Danliris_Stocklist_Controller::class, 'import'])->name('danliris_stockopname.import');
Route::get('danliris_stockopname/export', [Danliris_Stocklist_Controller::class, 'export'])->name('danliris_stockopname.export');
Route::get('danliris_stockopname/{id}/edit', [Danliris_Stocklist_Controller::class, 'edit'])->name('danliris_stockopname.edit');
// Route::get('danliris_stockopname/records', [Danliris_Stocklist_Controller::class, 'records'])->name(['danliris_stockopname.records']);

Route::resource('ag_stockopname', AG_Stocklist_Controller::class);
Route::post('/ag_stockopname/import', [AG_Stocklist_Controller::class, 'import'])->name('ag_stockopname.import');

Route::resource('efrata_stockopname', Efrata_Stocklist_Controller::class);
Route::post('/efrata_stockopname/import', [Efrata_Stocklist_Controller::class, 'import'])->name('efrata_stockopname.import');

//Stock
Route::resource('danliris_stock', Danliris_Stock_Controller::class)->except(['show']);

//upload RBT
// Route::resource('rbt', RBT_Controller::class)->except(['show']);
Route::resource('efrata_rbt', Efrata_RBT_Controller::class)->except(['show']);

Route::resource('danliris_rbt', Danliris_RBT_Controller::class)->except(['show']);
// Route::get('danliris_rbt/{id}/preview', Danliris_RBT_Controller::class, 'preview')->name(['danliris_rbt.preview']);

Route::resource('ag_rbt', AG_RBT_Controller::class)->except(['show']);

//upload Temperature
// Route::resource('temperature', Temperature_Controller::class)->except(['show']);
Route::resource('efrata_temperature', Efrata_Temperature_Controller::class)->except(['show']);
Route::resource('danliris_temperature', Danliris_Temperature_Controller::class)->except(['show']);
Route::resource('ag_temperature', AG_Temperature_Controller::class)->except(['show']);

//upload Ups
// Route::resource('ups', Ups_Controller::class)->except(['show']);
Route::resource('efrata_ups', Efrata_Ups_Controller::class)->except(['show']);
Route::resource('danliris_ups', Danliris_Ups_Controller::class)->except(['show']);
Route::resource('ag_ups', AG_Ups_Controller::class)->except(['show']);

//upload Server
// Route::resource('server', Server_Controller::class)->except(['show']);
Route::resource('efrata_server', Efrata_Server_Controller::class)->except(['show']);
Route::resource('danliris_server', Danliris_Server_Controller::class)->except(['show']);
Route::resource('ag_server', AG_Server_Controller::class)->except(['show']);

//upload change pc user
// Route::resource('change_pc_user', Change_Pc_User_Controller::class)->except(['show']);
Route::resource('danliris_change_pc_user', Danliris_Change_Pc_User_Controller::class)->except(['show']);
Route::resource('efrata_change_pc_user', Efrata_Change_Pc_User_Controller::class)->except(['show']);
Route::resource('ag_change_pc_user', AG_Change_Pc_User_Controller::class)->except(['show']);

//upload change email user
// Route::resource('change_email_user', Change_Email_User_Controller::class)->except(['show']);
Route::resource('efrata_change_email_user', Efrata_Change_Email_User_Controller::class)->except(['show']);
Route::resource('danliris_change_email_user', Danliris_Change_Email_User_Controller::class)->except(['show']);
Route::resource('ag_change_email_user', AG_Change_Email_User_Controller::class)->except(['show']);

//upload change wifi
// Route::resource('change_wifi', Change_Wifi_Controller::class)->except(['show']);
Route::resource('efrata_change_wifi', Efrata_Change_Wifi_Controller::class)->except(['show']);
Route::resource('danliris_change_wifi', Danliris_Change_Wifi_Controller::class)->except(['show']);
Route::resource('ag_change_wifi', AG_Change_Wifi_Controller::class)->except(['show']);

//upload kalibrasi alat
// Route::resource('kalibrasi_alat', Kalibrasi_Alat_Controller::class)->except(['show']);
Route::resource('efrata_kalibrasi_alat', Efrata_Kalibrasi_Alat_Controller::class)->except(['show']);
Route::resource('danliris_kalibrasi_alat', Danliris_Kalibrasi_Alat_Controller::class)->except(['show']);
Route::resource('ag_kalibrasi_alat', AG_Kalibrasi_Alat_Controller::class)->except(['show']);

//upload serah terima
// Route::resource('serah_terima', Serah_Terima_Controller::class)->except(['show']);
Route::resource('efrata_serah_terima', Efrata_Serah_Terima_Controller::class)->except(['show']);
Route::resource('danliris_serah_terima', Danliris_Serah_Terima_Controller::class)->except(['show']);
Route::resource('ag_serah_terima', AG_Serah_Terima_Controller::class)->except(['show']);