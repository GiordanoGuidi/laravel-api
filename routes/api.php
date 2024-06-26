<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TechnologyProjectController;
use App\Http\Controllers\Api\TypeProjectController;
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
    return response()->json(compact('projects'));
});

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{slug}', [ProjectController::class, 'show']);
//Rotta per i post legati a una categoria
Route::get('types/{slug}/projects', TypeProjectController::class);
//Rotta per i post legati alle tecnologie
Route::get('technologies/{slug}/projects', TechnologyProjectController::class);
//Rotta per ricevere un messaggio
Route::post('/contact-message', [ContactController::class, 'message']);
