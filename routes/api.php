<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
Route::get('/user', function () {
return auth()->user();
});
Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/posts', [PostController::class, 'store'])->middleware('permission:post-create');
    Route::put('/posts/{id}', [PostController::class, 'update'])->middleware('permission:post-edit');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('permission:post-delete');
    Route::post('/categories', [CategoryController::class, 'store'])->middleware('permission:category-manage');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->middleware('permission:category-manage');
});
