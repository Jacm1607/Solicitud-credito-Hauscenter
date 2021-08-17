<?php

use App\Http\Controllers\CreditController;
use App\Http\Controllers\UploadFileDependent;
use App\Http\Controllers\UploadFileIndependent;
use Illuminate\Support\Facades\Route;

Route::get('/', [CreditController::class, 'index']);
Route::get('solicit_credit_create', [CreditController::class, 'create'])->name('solicit_credit_create');
Route::post('solicit_credit_store', [CreditController::class, 'store'])->name('solicit_credit_store');

Route::get('upload_file_dependent', [UploadFileDependent::class, 'index'])->name('upload_file_dependent');
Route::post('upload_file_dependent_store', [UploadFileDependent::class, 'store'])->name('upload_file_dependent_store');

Route::get('upload_file_independent', [UploadFileIndependent::class, 'index'])->name('upload_file_independent');
Route::post('upload_file_independent_store', [UploadFileIndependent::class, 'store'])->name('upload_file_independent_store');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
