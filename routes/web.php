<?php

use App\Http\Controllers\Actor\ActorController;
use App\Http\Controllers\WebfingerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/.well-known/webfinger', [WebfingerController::class, 'search']);

Route::get('/u/{username}', [ActorController::class, 'show'])->name('actor.show');
