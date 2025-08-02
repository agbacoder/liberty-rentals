<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RentalController;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::middleware('auth:api')->post('logout', [AuthController::class, 'logout']);
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('/books', [BookController::class, 'getAllBooks']);
        Route::get('/book/{id}', [BookController::class, 'getBookDetails']);
        Route::post('/new_book', [BookController::class, 'createBooks']);
        Route::put('/book/{id}', [BookController::class, 'updateBooks']);
        Route::delete('/book/{id}', [BookController::class, 'deleteBook']);


        Route::post('book/{id}/rent', [RentalController::class, 'rentBook']);
        Route::post('book/{id}/return', [RentalController::class, 'returnBook']);
    });


});