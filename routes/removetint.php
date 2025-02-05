<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/removetint')->as('removetint.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'TintRemoveController@index')->name('index');
    Route::post('/store', 'TintRemoveController@store')->name('store');
});
