<?php

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rotas protegidas apenas com autenticação
Route::middleware(['auth', 'admin'])->group(function () {
    // Gerenciamento de usuários
    Route::resource('users', UserManagementController::class);

    // Participantes
    Route::resource('participants', ParticipantController::class);
    Route::get('participants/{participant}/card', [ParticipantController::class, 'showCard'])->name('participants.card');

    // Entregas
    Route::resource('deliveries', DeliveryController::class);
    Route::post('deliveries/{delivery}/participants/{participant}/status', [DeliveryController::class, 'updateParticipantStatus'])
        ->name('deliveries.participants.status');

    // Registros de entrega
    Route::post('delivery-records', [\App\Http\Controllers\DeliveryRecordController::class, 'store'])
        ->name('delivery-records.store');
});
