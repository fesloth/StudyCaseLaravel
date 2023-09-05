<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

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
    return view('welcome');
});

// Route::get('login', [SessionController::class, 'login'])->name('login');
// Route::post('/loginProses', [SessionController::class, 'loginProses'])->name('loginProses');
// Route::get('register', [SessionController::class, 'register'])->name('register');
// Route::post('/registerProses', [SessionController::class, 'registerProses'])->name('registerProses');

// Route::post('dashboard', [SessionController::class, 'getTotalProduk'])->name('getTotalProduk');
// Route::get('dashboard', [MainController::class, 'dashboard'])->name('dashboard');
// Route::get('dataProduk', [MainController::class, 'dataProduk'])->name('dataProduk');
// Route::get('dataProduk/create', [MainController::class, 'create']);
// Route::post('dataProduk/store', [MainController::class, 'store'])/.;.;;
// Route::get('dataProduk/edit/{id}', [MainController::class, 'edit'])->name('dataProduk.edit');
// Route::put('dataProduk/update/{id}', [MainController::class, 'update'])->name('dataProduk.update');
// Route::delete('/dataProduk/delete/{idBarang}', [MainController::class, 'delete'])->name('dataProduk.hapus');
// Route::get('/logout', [SessionController::class, 'logout'])->name('logout');P

Route::get('/', [ProdukController::class, 'index']);
Route::get('/product', [ProdukController::class, 'getAll']);
Route::get('/actions/tambahData', [ProdukController::class, 'createViews']);
Route::post('/product/store', [ProdukController::class, 'store']);
Route::get('/actions/editData/{id}', [ProdukController::class, 'edit']);
Route::put('/product/update/{id}', [ProdukController::class, 'update']);
Route::get('/actions/deleteData/{id}', [ProdukController::class, 'delete']);

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/registration', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/registration', [AuthController::class, 'register']);
