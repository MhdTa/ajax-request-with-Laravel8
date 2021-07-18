<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\messageController;








Route::post('/message', [messageController::class, 'store'])->name('message.add');
Route::get('/', [messageController::class, 'index'])->name('home');


