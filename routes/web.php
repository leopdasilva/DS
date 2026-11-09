<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\PortfolioController;

Route::get('/', function () {
    return view('portfolio');
});

// Atividade: Idade
Route::get('/idade', [PortfolioController::class, 'idade'])->name('idade');
Route::post('/idade', [PortfolioController::class, 'salvarIdade'])->name('idade.salvar');

// Atividade: Notas
Route::get('/notas', [PortfolioController::class, 'notas'])->name('notas');
Route::post('/notas', [PortfolioController::class, 'salvarNotas'])->name('notas.salvar');

// Atividade: Login Básico
Route::get('/login-basico', [PortfolioController::class, 'login'])->name('login');
Route::post('/login-basico', [PortfolioController::class, 'salvarLogin'])->name('login.salvar');

// Atividade: Cadastro de Jogos
Route::get('/jogos', [PortfolioController::class, 'jogos'])->name('jogos');
Route::post('/jogos', [PortfolioController::class, 'salvarJogos'])->name('jogos.salvar');

// Atividade: POO 2
Route::get('/poo2', [PortfolioController::class, 'poo2'])->name('poo2');
Route::post('/poo2', [PortfolioController::class, 'salvarPoo2'])->name('poo2.salvar');

// Atividade: Helpdesk
Route::get('/helpdesk', [HelpdeskController::class, 'index'])->name('helpdesk');
Route::post('/helpdesk', [HelpdeskController::class, 'salvar'])->name('helpdesk.salvar');

