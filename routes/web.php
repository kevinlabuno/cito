<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\MdController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\LaporanController;

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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('beranda', [BerandaController::class, 'index'])->name('beranda');

	

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');


    Route::get('coming',[BerandaController::class, 'coming'])->name('coming');
	Route::get('transaksi', [TransaksiController::class, 'index']);
	Route::get('setting', [SettingController::class, 'index']);
	Route::get('pengguna', [PenggunaController::class ,'index']);
	Route::get('daftar_transaksi', [TransaksiController::class, 'data_transaksi'])->name('daftar.transaksi');

	Route::get('harian_transaksi', [TransaksiController::class, 'harian_transaksi'])->name('harian.transaksi');

	Route::post('/transaksi', [TransaksiController::class, 'add_transaksi'])->name('add.transaksi');
	Route::delete('/daftar_transaksi/{id}', [TransaksiController::class, 'del_transaksi'])->name('del.transaksi');
	Route::get('/edit_transaksi/{id}/edit', [TransaksiController::class, 'edit_transaksi'])->name('edit.transaksi');
	Route::put('/edit_transaksi/{id}', [TransaksiController::class, 'update_transaksi'])->name('update.transaksi');
    
    Route::get('laporan', [LaporanController::class, 'index'])->name('index.laporan');
    Route::get('laporan_transaksi', [LaporanController::class, 'transaksi'])->name('laporan.transaksi');


	Route::get('/md', [MdController::class,'index'])->name('md.index');
	Route::get('/detail_md/{id_md}', [MdController::class, 'detail'])->name('md.detail');

	Route::get('/perawat', [NurseController::class,'index'])->name('perawat.index');
    Route::get('/detail_perawat/{id}', [NurseController::class, 'detail'])->name('perawat.detail');

	Route::post('/pengguna', [PenggunaController::class, 'add_pengguna'])->name('add.pengguna');
	Route::post('/pengguna/{user}/toggle-status', [PenggunaController::class, 'toggleStatus'])->name('toggle.status');

	Route::post('/add_time', [SettingController::class, 'add_time'])->name('add.time');
	Route::delete('/del_time/{id}', [SettingController::class, 'del_time'])->name('del.time');

	Route::post('/add_type', [SettingController::class, 'add_type'])->name('add.type');
	Route::delete('/del_type/{id}', [SettingController::class, 'del_type'])->name('del.type');
    
	Route::post('/add_method', [SettingController::class, 'add_method'])->name('add.method');
	Route::delete('/del_method/{id}', [SettingController::class, 'del_method'])->name('del.method');

	Route::post('/add_overtime', [SettingController::class, 'add_overtime'])->name('add.overtime');
	Route::delete('/del_overtime/{id}', [SettingController::class, 'del_overtime'])->name('del.overtime');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('beranda');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');