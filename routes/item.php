<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/item')->as('item.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'ItemController@index')->name('index');
    Route::get('/create', 'ItemController@create')->name('create');
    Route::post('/store', 'ItemController@store')->name('store');
    Route::get('/edit/{item}', 'ItemController@edit')->name('edit');
    Route::post('/update/{item}', 'ItemController@update')->name('update');
    Route::get('/destroy/{item}', 'ItemController@destroy')->name('destroy');
});
