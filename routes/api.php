<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Actions\AuthAction;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FishController;

Route::post('register', [UserController::class, 'store'])->name('user.add');
Route::post('/login', [AuthAction::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('book', BookController::class)->only('index', 'store')
        ->names([
            'store' => 'book.add',
            'index' => 'book.index',
        ]);
    Route::put('book/{id}', [BookController::class, 'update'])->name('book.update');
    Route::get('book/{id}', [BookController::class, 'show'])->name('book.show');
    Route::delete('book/{id}', [BookController::class, 'delete'])->name('book.delete');

    Route::resource('fish', FishController::class)->only(['index', 'store'])
        ->names([
            'index' => 'fish.index',
            'store' => 'fish.add',
        ]);
    Route::put('fish/{id}', [FishController::class, 'update'])->name('fish.edit');
    Route::delete('fish/{id}', [FishController::class, 'delete'])->name('fish.delete');

    Route::put('updatePassword', [UserController::class, 'update'])->name('update.password');
});
