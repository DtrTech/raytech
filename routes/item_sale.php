<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/item_sale')->as('item_sale.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'ItemSaleController@index')->name('index');
    Route::get('/create', 'ItemSaleController@create')->name('create');
    Route::post('/store', 'ItemSaleController@store')->name('store');
    Route::get('/edit/{item_sale}', 'ItemSaleController@edit')->name('edit');
    Route::post('/update/{item_sale}', 'ItemSaleController@update')->name('update');
    Route::get('/destroy/{item_sale}', 'ItemSaleController@destroy')->name('destroy');
});
