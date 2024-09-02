<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{id}', [DocumentController::class, 'show'])->name('documents.show');

    // Route to list all processed documents
    Route::get('/documents/processed', [DocumentController::class, 'listProcessedDocuments'])->name('documents.processed');

    // Route to show the document upload form
    Route::get('/documents/upload', function () { return view('documents.document_upload'); })->name('documents.upload_form');

    // Route to handle the document upload
    Route::post('/documents/upload', [DocumentController::class, 'uploadDocument'])->name('documents.upload');

});

