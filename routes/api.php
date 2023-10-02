<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/apiProduk', ApiController::class); 
Route::get('/detailProduk/{id}', [ApiController::class, 'getDetailProduk']);
Route::post('/createProduk', [ApiController::class, 'createProduk']);
Route::put('/updateProduk/{id}', [ApiController::class, 'updateProduk']);
Route::delete('/deleteProduk/{id}', [ApiController::class, 'deleteProduk']);
Route::get('/dataUser', [ApiController::class, 'getDataUser']);
Route::get('/totalUser', [ApiController::class, 'getTotalUser']);


