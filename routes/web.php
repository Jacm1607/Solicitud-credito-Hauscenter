<?php

use App\Http\Controllers\CreditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UploadFileDependent;
use App\Http\Controllers\UploadFileIndependent;
use Illuminate\Support\Facades\Route;

Route::get('/', [CreditController::class, 'index']);
Route::get('/sucursales', [CreditController::class, 'branch_offices'])->name('branch_offices');
Route::get('/solicitar-credito', [CreditController::class, 'create'])->name('solicit_credit_create');
Route::get('/descargar', [CreditController::class , 'buro_crediticio_pdf'])->name('download_pdf');
Route::post('solicit_credit_store', [CreditController::class, 'store'])->name('solicit_credit_store');
Route::get('/finalizar-solicitud', [CreditController::class, 'finish'])->name('finish_credit');

Route::get('/cargar-archivo-dependiente', [UploadFileDependent::class, 'index'])->name('upload_file_dependent');
Route::post('upload_file_dependent_store', [UploadFileDependent::class, 'store'])->name('upload_file_dependent_store');

Route::get('/cargar-archivo-independiente', [UploadFileIndependent::class, 'index'])->name('upload_file_independent');
Route::post('upload_file_independent_store', [UploadFileIndependent::class, 'store'])->name('upload_file_independent_store');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class , 'index'] )->name('dashboard');
Route::get('/show/{id}', [DashboardController::class, 'show'])->name('show');
Route::get('/download', [DashboardController::class, 'getFile'])->name('download_file');
