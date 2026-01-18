<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/u/{username}', [ActorController::class, 'show']);
