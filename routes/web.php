<?php

use App\Models\Brgmasuk;
use App\Models\Laporanharian;
use App\Models\Masterpegawai;
use App\Models\Pendafoutlite;
use App\Models\Mastersupplier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BrgmasukController;
use App\Http\Controllers\BrgkeluarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MastertokoController;
use App\Http\Controllers\MasterbarangController;
use App\Http\Controllers\LaporanharianController;
use App\Http\Controllers\MasterpegawaiController;
use App\Http\Controllers\PendafoutliteController;
use App\Http\Controllers\MastersupplierController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    $jumlahsales = Masterpegawai::count();
    return view('dashboard', compact('jumlahsales'));
})->middleware('auth');


Route::prefix('dashboard')->middleware(['auth:sanctum'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Master Data
    Route::resource('masterpegawai', MasterpegawaiController::class);
    Route::resource('mastertoko', MastertokoController::class);
    Route::resource('mastersupplier', MastersupplierController::class);
    Route::resource('masterbarang', MasterbarangController::class);

// Data Tables
    Route::resource('pendafoutlite', PendafoutliteController::class);
    Route::resource('brgmasuk', BrgmasukController::class);
    Route::resource('brgkeluar', BrgkeluarController::class);
    Route::resource('laporanharian', LaporanharianController::class);



// cetak PDF
// Master Data
Route::get('masterpegawaipdf', [MasterpegawaiController::class, 'masterpegawaipdf'])->name('masterpegawaipdf');
Route::get('mastertokopdf', [MasterpegawaiController::class, 'mastertokopdf'])->name('mastertokopdf');
Route::get('mastersupplierpdf', [MastersupplierController::class, 'mastersupplierpdf'])->name('mastersupplierpdf');
Route::get('masterbarangpdf', [MastersupplierController::class, 'masterbarangpdf'])->name('masterbarangpdf');
Route::get('laporanharianpdf', [LaporanharianController::class, 'laporanharianpdf'])->name('laporanharianpdf');



// Data Tables
Route::get('pendafoutlitepdf', [PendafoutliteController::class, 'pendafoutlitepdf'])->name('pendafoutlitepdf');
Route::get('brgmasukpdf', [BrgmasukController::class, 'brgmasukpdf'])->name('brgmasukpdf');
Route::get('brgkeluarpdf', [BrgkeluarController::class, 'brgkeluarpdf'])->name('brgkeluarpdf');
Route::get('laporanharianpdf', [LaporanharianController::class, 'laporanharianpdf'])->name('laporanharianpdf');
// Route::get('pernamapdf', [LaporanharianController::class, 'pernamapdf'])->name('pernamapdf');



// Validasi
Route::patch('sales/{id}/validasi', [PendafoutliteController::class, 'validasi'])->name('validasisales');

// Recap
Route::get('laporansales/pernama', [PendafoutliteController::class, 'pernama'])->name('pernama');


// Filter
Route::get('pernamapdf/filter={filter}', [PendafoutliteController::class, 'pernama_pdf'])->name('pernamapdf');

});



// Login Register
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/loginuser', [LoginController::class, 'loginuser'])->name('loginuser');








