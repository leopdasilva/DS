<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\PortfolioController;

Route::get('/', function () {
    return view('portfolio');
});

Route::get('/idade', [PortfolioController::class, 'idade'])->name('idade');

Route::post('/idade', [PortfolioController::class, 'salvarIdade'])->name('idade.salvar');

Route::get('/helpdesk', [HelpdeskController::class, 'index'])->name('helpdesk');

Route::post('/helpdesk', [HelpdeskController::class, 'salvar'])->name('helpdesk.salvar');

