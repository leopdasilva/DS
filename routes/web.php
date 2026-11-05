<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpdeskController;

Route::get('/', function () {
    return view('portfolio');
});

Route::get('/helpdesk', [HelpdeskController::class, 'index'])->name('helpdesk');