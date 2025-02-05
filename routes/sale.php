<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/sale')->as('sale.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'SaleController@index')->name('index');
    Route::get('/create', 'SaleController@create')->name('create');
    Route::post('/store', 'SaleController@store')->name('store');
    Route::get('/edit/{sale}', 'SaleController@edit')->name('edit');
    Route::post('/update/{sale}', 'SaleController@update')->name('update');
    Route::get('/destroy/{sale}', 'SaleController@destroy')->name('destroy');
});
