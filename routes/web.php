<?php

use Illuminate\Support\Facades\Route;
use MichaelDojcar\LaravelAdmin\Http\Controllers\AdminController;
use MichaelDojcar\LaravelAdmin\Http\Middleware\Authenticate;

Route::group([
    'prefix' => 'admin',
    'middleware' => [Authenticate::class],
    'as' => 'admin::',
], function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
});