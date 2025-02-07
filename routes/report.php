<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/report')->as('report.')->middleware(['auth'])->group(function() {
    Route::get('/by_car', 'ReportController@by_car')->name('by_car');
    Route::get('/by_user', 'ReportController@by_user')->name('by_user');
    Route::get('/details', 'ReportController@details')->name('details');
});
