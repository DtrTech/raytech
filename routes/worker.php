<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/worker')->as('worker.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'WorkerController@index')->name('index');
    Route::get('/create', 'WorkerController@create')->name('create');
    Route::post('/store', 'WorkerController@store')->name('store');
    Route::get('/edit/{worker}', 'WorkerController@edit')->name('edit');
    Route::post('/update/{worker}', 'WorkerController@update')->name('update');
    Route::get('/destroy/{worker}', 'WorkerController@destroy')->name('destroy');
});
