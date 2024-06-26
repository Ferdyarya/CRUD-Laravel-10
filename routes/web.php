<?php

use App\Models\Brgmasuk;
use App\Models\Laporanharian;
use App\Models\Masterpegawai;
use App\Models\Pendafoutlite;
use App\Models\Mastersupplier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BrgmasukController;
use App\Http\Controllers\BrgreturController;
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
    Route::resource('brgretur', BrgreturController::class);




// Master Data Report
Route::get('masterpegawaipdf', [MasterpegawaiController::class, 'masterpegawaipdf'])->name('masterpegawaipdf');
Route::get('mastertokopdf', [MasterpegawaiController::class, 'mastertokopdf'])->name('mastertokopdf');
Route::get('mastersupplierpdf', [MastersupplierController::class, 'mastersupplierpdf'])->name('mastersupplierpdf');
Route::get('masterbarangpdf', [MastersupplierController::class, 'masterbarangpdf'])->name('masterbarangpdf');
Route::get('laporanharianpdf', [LaporanharianController::class, 'laporanharianpdf'])->name('laporanharianpdf');
Route::get('brgreturpdf', [BrgreturController::class, 'brgreturpdf'])->name('brgreturpdf');



// Data Tables Report Report
Route::get('pendafoutlitepdf', [PendafoutliteController::class, 'pendafoutlitepdf'])->name('pendafoutlitepdf');
Route::get('brgmasukpdf', [BrgmasukController::class, 'brgmasukpdf'])->name('brgmasukpdf');
Route::get('brgkeluarpdf', [BrgkeluarController::class, 'brgkeluarpdf'])->name('brgkeluarpdf');
Route::get('laporanharianpdf', [LaporanharianController::class, 'laporanharianpdf'])->name('laporanharianpdf');
Route::get('brgreturpdf', [BrgreturController::class, 'brgreturpdf'])->name('brgreturpdf');
// Route::get('pernamapdf', [LaporanharianController::class, 'pernamapdf'])->name('pernamapdf');


// Validasi
Route::patch('sales/{id}/validasi', [PendafoutliteController::class, 'validasi'])->name('validasisales');

// Recap Laporan Tampilan
Route::get('laporansales/pernama', [PendafoutliteController::class, 'pernama'])->name('pernama');
Route::get('laporansales/laporanoutlet', [PendafoutliteController::class, 'cetakpegawaipertanggal'])->name('laporanoutlet');
Route::get('laporansales/laporanbrgmasuk', [BrgmasukController::class, 'cetakbarangpertanggal'])->name('laporanbrgmasuk');
Route::get('laporansales/laporanorderan', [BrgkeluarController::class, 'cetakbrgkeluarpertanggal'])->name('laporanorderan');
Route::get('laporansales/laporanhariansales', [LaporanharianController::class, 'cetakhariansalespertanggal'])->name('laporanhariansales');
Route::get('laporansales/laporanbrgretur', [BrgreturController::class, 'cetakbrgreturpertanggal'])->name('laporanbrgretur');

Route::get('laporansales/invoicepdf', [BrgkeluarController::class, 'invoicepdf'])->name('invoicepdf');
Route::get('laporansales/suratjalanpdf', [BrgkeluarController::class, 'suratjalanpdf'])->name('suratjalanpdf');
Route::get('invoicepdf/{filter}', [BrgkeluarController::class, 'invoicepdf'])->name('invoicepdf');
Route::get('suratjalanpdf/{filter}', [BrgkeluarController::class, 'suratjalanpdf'])->name('suratjalanpdf');

// Filtering
Route::get('laporanoutlet', [PendafoutliteController::class, 'filterdate'])->name('laporanoutlet');
Route::get('laporanbrgmasuk', [BrgmasukController::class, 'filterdatebarang'])->name('laporanbrgmasuk');
Route::get('laporanorderan', [BrgkeluarController::class, 'filterdatebrgkeluar'])->name('laporanorderan');
Route::get('laporanhariansales', [LaporanharianController::class, 'filterdatehariansales'])->name('laporanhariansales');
Route::get('laporanbrgretur', [BrgreturController::class, 'filterdatebrgretur'])->name('laporanbrgretur');



// Filter Laporan
Route::get('pernamapdf/filter={filter}', [PendafoutliteController::class, 'pernama_pdf'])->name('pernamapdf');
Route::get('laporanoutletpdf/filter={filter}', [PendafoutliteController::class, 'laporanoutletpdf'])->name('laporanoutletpdf');
Route::get('laporanbrgmasukpdf/filter={filter}', [BrgmasukController::class, 'laporanbrgmasukpdf'])->name('laporanbrgmasukpdf');
Route::get('laporanorderanpdf/filter={filter}', [BrgkeluarController::class, 'laporanorderanpdf'])->name('laporanorderanpdf');
Route::get('laporanhariansalespdf/filter={filter}', [LaporanharianController::class, 'laporanhariansalespdf'])->name('laporanhariansalespdf');
Route::get('laporanbrgreturpdf/filter={filter}', [BrgreturController::class, 'laporanbrgreturpdf'])->name('laporanbrgreturpdf');


});



// Login Register
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/loginuser', [LoginController::class, 'loginuser'])->name('loginuser');








