<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\ShareDocumentController;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/invoice_paid', [DashboardController::class, 'invoice_paid'])->middleware(['auth', 'verified'])->name('invoice_paid');
Route::get('/invoice_unpaid', [DashboardController::class, 'invoice_unpaid'])->middleware(['auth', 'verified'])->name('invoice_unpaid');
Route::get('/invoice_sent', [DashboardController::class, 'invoice_sent'])->middleware(['auth', 'verified'])->name('invoice_sent');
Route::get('/invoice_cancel', [DashboardController::class, 'invoice_cancel'])->middleware(['auth', 'verified'])->name('invoice_cancel');
Route::get('/invoice_recurring', [DashboardController::class, 'invoice_recurring'])->middleware(['auth', 'verified'])->name('invoice_recurring');


// Document
Route::get('document', [DocumentController::class, 'index'])->middleware(['auth', 'verified'])->name('document');
Route::get('viewdocument/{id}', [DocumentController::class, 'viewdocument'])->middleware(['auth', 'verified'])->name('viewdocument');
Route::post('document', [DocumentController::class, 'store'])->middleware(['auth', 'verified'])->name('document.store');
Route::post('create_folder', [DocumentController::class, 'create_folder'])->middleware(['auth', 'verified'])->name('document.create_folder');
Route::get('view-folder-doc/{user_id}/{folder_id}', [DocumentController::class, 'viewFolderDoc'])->middleware(['auth', 'verified'])->name('view-folder-doc');
Route::get('customer-document/{user_id}/{folder_id}', [DocumentController::class, 'customerdocuments'])->middleware(['auth', 'verified'])->name('customer-document');
Route::post('update-folder', [DocumentController::class, 'update'])->middleware(['auth', 'verified'])->name('update-folder');

// ShareDocument
Route::post('shareDocuments', [ShareDocumentController::class, 'shareDocuments'])->middleware(['auth', 'verified'])->name('shareDocuments');
Route::get('shared', [ShareDocumentController::class, 'shared'])->middleware(['auth', 'verified'])->name('shared');
Route::get('my-document', [ShareDocumentController::class, 'mydocument'])->middleware(['auth', 'verified'])->name('my-document');
Route::get('sharedToAdmin', [ShareDocumentController::class, 'sharedToAdmin'])->middleware(['auth', 'verified'])->name('sharedToAdmin');


