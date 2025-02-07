<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/item_commission')->as('item_commission.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'ItemCommissionController@index')->name('index');
    Route::get('/edit/{item_commission}', 'ItemCommissionController@edit')->name('edit');
    Route::post('/update/{item_commission}', 'ItemCommissionController@update')->name('update');
});
