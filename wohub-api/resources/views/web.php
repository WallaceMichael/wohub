<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group('/api/v1', function () {
    Route::get('/', function () {
        log("oi");
        return view('welcome');
    });
});
