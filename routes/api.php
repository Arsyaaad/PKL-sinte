<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Detail_MaintenanceController;
use App\Http\Controllers\Api\MaintenanceController;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\PetugasController;
use App\Http\Controllers\Api\ProdukController;

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
//posts
Route::apiResource('/detail_maintenances', App\Http\Controllers\Api\Detail_MaintenanceController::class);
Route::get('/detail/{id}', [App\Http\Controllers\Api\Detail_MaintenanceController::class, 'index']);
Route::apiResource('/maintenances', App\Http\Controllers\Api\MaintenanceController::class);
Route::apiResource('/pelanggans', App\Http\Controllers\Api\PelangganController::class);
Route::apiResource('/petugas', App\Http\Controllers\Api\PetugasController::class);
Route::apiResource('/produks', App\Http\Controllers\Api\ProdukController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
