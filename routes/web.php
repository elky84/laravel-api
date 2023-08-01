<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return 'Hi';
});

Route::get('/api/books', [BookController::class, 'index'])->name('books.index');

// store 요청은 form 을 통해 post 로 옵니다.
Route::post('/api/books', [BookController::class, 'store'])->name('books.store');

Route::get('/api/books/{bookId}', [BookController::class, 'show'])->name("books.show");

// Laravel에서 업데이트의 대한 메서드로는 Patch 또는 Put을 권장합니다.
Route::patch('/api/books/{bookId}', [BookController::class, 'update'])->name('books.update');

Route::delete('/api/books/{bookId}', [BookController::class, 'destroy'])->name('books.destroy');
