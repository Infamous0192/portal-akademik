<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(API\FakultasController::class)->group(function () {
    Route::get('fakultas', 'index');
    Route::get('fakultas/{fakultas}', 'show');
    Route::post('fakultas', 'store');
    Route::put('fakultas/{fakultas}', 'update');
    Route::delete('fakultas/{fakultas}', 'delete');
})->middleware('auth');

Route::controller(API\ProdiController::class)->group(function () {
    Route::get('prodi', 'index');
    Route::get('prodi/{prodi}', 'show');
    Route::post('prodi', 'store');
    Route::put('prodi/{prodi}', 'update');
    Route::delete('prodi/{prodi}', 'delete');
})->middleware('auth');

Route::controller(API\GedungController::class)->group(function () {
    Route::get('gedung', 'index');
    Route::get('gedung/{gedung}', 'show');
    Route::post('gedung', 'store');
    Route::put('gedung/{gedung}', 'update');
    Route::delete('gedung/{gedung}', 'delete');
})->middleware('auth');

Route::controller(API\RuanganController::class)->group(function () {
    Route::get('ruangan', 'index');
    Route::get('ruangan/{ruangan}', 'show');
    Route::post('ruangan', 'store');
    Route::put('ruangan/{ruangan}', 'update');
    Route::delete('ruangan/{ruangan}', 'delete');
})->middleware('auth');
