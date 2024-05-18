<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UsersManagement\UsersController;
use App\Http\Livewire\Application\ViewApplication;
use App\Http\Livewire\Payment\ViewPaymentDetails;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('product',[RazorpayController::class,'index']);
Route::post('razorpay-payment',[RazorpayController::class,'store'])->name('razorpay.payment.store');

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
        Route::get('/info-murid', [ViewApplication::class, 'getStudentDetails'])->name('info_murid');
        Route::post('/status-permohonan', [ViewApplication::class, 'updateApplication'])->name('status_permohonan');
        Route::get('/datatable_updated_application', [ApplicationController::class, 'datatable_updated_application'])->name('datatable_updated_application');
    });

    // Users routes
    Route::prefix('pengguna')->as('pengguna.')->group(function (){
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('/admin', [UsersController::class, 'indexAdmin'])->name('index_admin');
        Route::post('/kemaskini-profil', [UsersController::class, 'updateProfile'])->name('kemaskini_profil');
        Route::get('/datatable_user_list', [UsersController::class, 'datatable_user_list'])->name('datatable_user_list');
        Route::get('/kemaskini-pengguna/{userId}', [UsersController::class, 'updateUser'])->name('kemaskini_pengguna');
        Route::post('/buang-pengguna', [UsersController::class, 'deleteUser'])->name('buang_pengguna');
        Route::get('/pengguna-baru', [UsersController::class, 'createUser'])->name('penggunaBaru');
        Route::post('/simpan', [UsersController::class, 'saveNewUser'])->name('simpan');
    });
    
    // Payment routes
    Route::prefix('pembayaran')->as('pembayaran.')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index');
        Route::get('/yuran/{studentId}', [PaymentController::class, 'paymentByStudent'])->name('yuran_student');
        Route::get('/transaksi', [PaymentController::class, 'makePayment'])->name('buat_pembarayan');

        Route::post('/session', [StripeController::class, 'session'])->name('session');
        // Route::get('/status/{studentId}/{monthId}/{session_id}', [StripeController::class, 'status'])->name('status');
        Route::get('/status/{studentId}/{year}/{monthId}', [StripeController::class, 'status'])->name('status');
        // Route::get('/resit-pembayaran', [ViewPaymentDetails::class, 'getPaymentDetails'])->name('resit_pembayaran');
    });

    // Student's Activity routes
    Route::prefix('murid')->as('murid.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/kelas', [StudentController::class, 'studentClass'])->name('kelas');
        Route::get('/datatable_class_list', [StudentController::class, 'datatable_class_list'])->name('datatable_class_list');
        Route::get('/kelas/{classId}', [StudentController::class, 'classDetails'])->name('kelas_detail');
        Route::get('/datatable_student_list', [StudentController::class, 'datatable_student_list'])->name('datatable_student_list');
        Route::get('/datatable_all_student_list', [StudentController::class, 'datatable_all_student_list'])->name('datatable_all_student_list');
        Route::post('/add_student_to_class', [StudentController::class, 'addStudentToClass'])->name('add_student_to_class');
        Route::post('/remove_student_from_class', [StudentController::class, 'removeStudentFromClass'])->name('remove_student_from_class');
    });

});
