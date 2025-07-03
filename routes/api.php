<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Spatie\Permission\Middleware\PermissionMiddleware;
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
    Route::put('/posts/{post}', [PostController::class, 'update'])->middleware('permission:post-edit');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('permission:post-delete');
    Route::post('/categories', [CategoryController::class, 'store'])->middleware('permission:category-manage');
    Route::get('/categories', [CategoryController::class, 'index'])->middleware('permission:category-manage');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->middleware('permission:category-manage');
    Route::get('/categories/export', [CategoryController::class, 'export'])->middleware('permission:category-manage');
    Route::post('/categories/import', [CategoryController::class, 'import'])->middleware('permission:category-manage');


});

Route::get('public/posts', [PostController::class, 'index']);
Route::get('/posts/export', [PostController::class, 'export']);
