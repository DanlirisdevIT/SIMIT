<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddAdminController;

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
