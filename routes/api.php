<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ContactController;

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

Route::resource('projects', ProjectController::class)->only(['index', 'show']);

// Aggiungere rotta api per ricevere i dati dal frontend da una chiamata
// ricordati che c'è comunque /api
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
