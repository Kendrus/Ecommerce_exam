<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CommandeProduitController;

use App\Http\Controllers\StatController;


Route::apiResource('produitf', ProduitController::class);
Route::apiResource('commandec', CommandeController::class);
Route::apiResource('commandeproduitc', CommandeProduitController::class);
Route::apiResource('clientc', ClientController::class);

Route::apiResource('clientf', ClientController::class);
Route::apiResource('categorief', CategoryController::class);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Routes protégées par le middleware auth:api
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::apiResource('produit', ProduitController::class);
Route::apiResource('client', ClientController::class);
Route::apiResource('categorie', CategoryController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('commandes', CommandeController::class);
Route::apiResource('commandeproduit', CommandeProduitController::class);
Route::put('etat/{id}', [CommandeController::class, 'etat'])->name('etat');

Route::get('/dashboard/count', [StatController::class, 'count']);
Route::get('/dashboard/clientm', [StatController::class, 'clientm']);
Route::get('/dashboard/clientf', [StatController::class, 'clientf']);
Route::get('/dashboard/produit', [StatController::class, 'produit']);
Route::get('/clients/pdf/all', [ClientController::class, 'generateAllClientsPdf']);
Route::get('/produits/export/excel', [ProduitController::class, 'exportExcel']);
Route::get('userl', [UserController::class, 'getUser']);

Route::get('/export', [ProduitController::class, 'export']);

});

;
