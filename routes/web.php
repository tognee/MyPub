<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebfingerController;
use App\Http\Controllers\Actor\ActorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/.well-known/webfinger', [WebfingerController::class, 'search']);

Route::get('/u/{username}', [ActorController::class, 'show'])->name('actor.show');
