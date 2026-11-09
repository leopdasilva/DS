<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpdeskController;

Route::get('/', function () {
    return view('portfolio');
});

Route::get('/idade', [HelpdeskController::class, 'index'])->name('idade');

Route::post('/idade', [HelpdeskController::class, 'salvarIdade'])->name('idade.salvar');

Route::get('/helpdesk', [HelpdeskController::class, 'index'])->name('helpdesk');

Route::post('/helpdesk', [HelpdeskController::class, 'salvar'])->name('helpdesk.salvar');

