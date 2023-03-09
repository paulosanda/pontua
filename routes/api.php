<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Actions\AuthAction;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [UserController::class, 'store'])->name('user.add');
Route::post('/login', [AuthAction::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('book', BookController::class)->only('index', 'store')
        ->names(['store' => 'book.add']);
    Route::put('book/{id}', [BookController::class, 'update'])->name('book.update');
    Route::get('book/{id}', [BookController::class, 'show'])->name('book.show');
    Route::delete('book/{id}', [BookController::class, 'delete'])->name('book.delete');
});
