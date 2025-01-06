<?php

use App\Http\Controllers\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();

    Route::get('/webhook/is_premium', [WebhookController::class, 'is_premium'])->name('webhook.is_premium');
    Route::post('/webhook/reserva', [WebhookController::class, 'recibirReserva'])->name('webhook.reserva');
})->middleware('auth:sanctum');
