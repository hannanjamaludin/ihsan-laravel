<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    // Application routes
    Route::prefix('pendaftaran')->as('pendaftaran.')->group(function (){
        Route::get('/', [ApplicationController::class, 'index'])->name('index');
        Route::get('/pendaftaran-baru', [ApplicationController::class, 'createApplication'])->name('pendaftaranBaru');
        Route::get('/pendaftaran-baru-final', [ApplicationController::class, 'createApplicationNext'])->name('pendaftaranBaruFinal');
        Route::get('/permohonan', [ApplicationController::class, 'updateApplication'])->name('permohonan');
        Route::get('/status', [ApplicationController::class, 'viewApplicationParent'])->name('status');
        Route::get('/datatable_application_list', [ApplicationController::class, 'datatable_application_list'])->name('datatable_application_list');
        Route::post('/simpan_permohonan', [ApplicationController::class, 'storeSession'])->name('store_application_session');
        Route::post('/simpan_permohonan_final', [ApplicationController::class, 'store'])->name('simpan_permohonan');
        Route::post('/daerah', 'ApplicationController@getDistrict')->name('daerah');
        Route::post('/buang_permohonan', [ApplicationController::class, 'deleteApplication'])->name('buang_permohonan');
    });

});
