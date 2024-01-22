<?php

use App\Models\Masterpegawai;
use App\Models\Mastersupplier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MastertokoController;
use App\Http\Controllers\MasterpegawaiController;
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

// Master Data Pegawai
// Route::resource('masterpegawai', MasterpegawaiController::class);
// // index
// Route::get('/masterpegawai', [MasterpegawaiController::class, 'index'])->name('masterpegawai')->middleware('auth');
// // Create Data
// Route::get('/tambahmasterpegawai', [MasterpegawaiController::class, 'tambahmasterpegawai'])->name('tambahmasterpegawai');
// Route::post('/insertmasterpegawai', [MasterpegawaiController::class, 'insertmasterpegawai'])->name('insertmasterpegawai');
// // Update Data
// Route::get('/tampildata/{id}', [MasterpegawaiController::class, 'tampildata'])->name('tampildata');
// Route::post('/updatedata/{id}', [MasterpegawaiController::class, 'updatedata'])->name('updatedata');
// // Hapus Data
// Route::get('/delete/{id}', [MasterpegawaiController::class, 'delete'])->name('delete');
// // Export PDF
// Route::get('/masterpegawaipdf', [MasterpegawaiController::class, 'masterpegawaipdf'])->name('masterpegawaipdf');

Route::prefix('dashboard')->middleware(['auth:sanctum'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('masterpegawai', MasterpegawaiController::class);
    Route::resource('mastertoko', MastertokoController::class);
    Route::resource('mastersupplier', MastersupplierController::class);


// cetak PDF
Route::get('masterpegawaipdf', [MasterpegawaiController::class, 'masterpegawaipdf'])->name('masterpegawaipdf');
Route::get('mastertokopdf', [MasterpegawaiController::class, 'mastertokopdf'])->name('mastertokopdf');
Route::get('mastersupplierpdf', [MastersupplierController::class, 'mastersupplierpdf'])->name('mastersupplierpdf');





});



// Login Register
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/loginuser', [LoginController::class, 'loginuser'])->name('loginuser');








