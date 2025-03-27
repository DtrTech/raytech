<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/report')->as('report.')->middleware(['auth'])->group(function() {
    Route::get('/by_car', 'ReportController@by_car')->name('by_car');
    Route::get('/by_user', 'ReportController@by_user')->name('by_user');
    Route::get('/tint_sale_details', 'ReportController@tint_sale_details')->name('tint_sale_details');
    Route::get('/item_sale_details', 'ReportController@item_sale_details')->name('item_sale_details');
    Route::get('/worker_item_sales_report', 'ReportController@worker_item_sales_report')->name('worker_item_sales_report');
});
