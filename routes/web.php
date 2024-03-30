<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Livewire\Application\ViewApplication;
use App\Models\Application;
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
        Route::post('/simpan-permohonan', [ApplicationController::class, 'storeSession'])->name('store_application_session');
        Route::post('/simpan-permohonan_final', [ApplicationController::class, 'store'])->name('simpan_permohonan');
        Route::post('/daerah', 'ApplicationController@getDistrict')->name('daerah');
        Route::post('/buang-permohonan', [ApplicationController::class, 'deleteApplication'])->name('buang_permohonan');
        Route::get('/info-pelajar', [ViewApplication::class, 'getStudentDetails'])->name('info_pelajar');
        Route::post('/status-permohonan', [ViewApplication::class, 'updateApplication'])->name('status_permohonan');
        Route::get('/datatable_updated_application', [ApplicationController::class, 'datatable_updated_application'])->name('datatable_updated_application');
    });

});
