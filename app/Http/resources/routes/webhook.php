<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MercadoPagoWebhookController;




Route::prefix('webhook')->name('webhook.')->group(function () {

    Route::prefix('mercado-pago')->name('mercado-pago.')->group(function () {
        Route::post('/', [MercadoPagoWebhookController::class, 'index'])->name('index');
    });
});
