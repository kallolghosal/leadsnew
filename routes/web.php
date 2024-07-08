<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('wv-leads', [HomeController::class, 'wvleads'])->name('wv-leads');
Route::get('cac-leads', [HomeController::class, 'cacleads'])->name('cac-leads');
Route::get('wvmarket-leads', [HomeController::class, 'wvmarket'])->name('wvmarket-leads');
Route::get('export-leads', [ExportController::class, 'exportLeads'])->name('export-leads');
Route::get('import-csv', [ImportController::class, 'importCsv'])->name('import-csv');
Route::get('savedata/{name}/{owner}', [ImportController::class, 'saveFile'])->name('store-file');
Route::post('show-csv', [ImportController::class, 'showCsvData'])->name('show-csv');
Route::get('remove', [HomeController::class, 'removeLeads'])->name('removeleads');
Route::get('removecac/{st}/{nd}', [HomeController::class, 'removecac'])->name('remove-cac');
Route::get('removewv/{st}/{nd}', [HomeController::class, 'removewv'])->name('remove-wv');
Route::get('removemrkt/{st}/{nd}', [HomeController::class, 'removemrkt'])->name('remove-mrkt');

// Route to export WV data
Route::get('export-csv/{st}/{nd}', [ExportController::class, 'exportToCsv'])->name('download-csv');

// Route to export CAC data
Route::get('export-cacdata/{st}/{nd}', [ExportController::class, 'exportCsvData'])->name('download-cacdata');

// Route to export WV Market data
Route::get('mrkt-csv/{st}/{nd}', [ExportController::class, 'exportMrktData'])->name('download-mrktdata');
