<?php

use App\Http\Controllers\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/webhook/is_premium', [WebhookController::class, 'is_premium'])->name('webhook.is_premium');
Route::get('/webhook/reserva', [WebhookController::class, 'recibirReserva'])->name('webhook.reserva');
