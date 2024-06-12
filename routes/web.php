<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

// Signup, Login, Logout
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/signup', [AuthController::class, 'signupPage']);
Route::post('/signup', [UserController::class, 'create']);

Route::post('/logout', [AuthController::class, 'logout']);

// Guest Routes
Route::get('/', [HomeController::class, 'index'])->name('posts');

// User Routes
Route::patch('/users/{userId}', [UserController::class, 'update'])->name('updateUser');
Route::delete('/users/{userId}', [UserController::class, 'deleteWithPosts'])->name('deleteUser');

// Post Routes

Route::post('/posts', [PostController::class, 'create']);

Route::get('/posts/{postId}', [PostController::class, 'getPost'])->middleware('auth')->name('post');
Route::patch('/posts/{postId}', [PostController::class, 'update'])->name('updatePost');
Route::delete('/posts/{postId}', [PostController::class, 'delete'])->name('deletePost');

Route::get('/posts/{postId}/edit', [PostController::class, 'getPostEdit'])->name('postEditPage');

Route::get('/post-create', [PostController::class, 'createPostPage'])->middleware('auth');

// Profile Routes
Route::get('/profile/{userId}', [ProfileController::class, 'index'])->middleware('auth')->name('profile');

Route::get('/profile/{userId}/edit', [ProfileController::class, 'edit'])->middleware('auth.profile.owner')->name('profileEdit');

// Admin Routes
Route::middleware('can:super-admin')->group(function () {
    Route::get('/categories', [CategoryController::class, 'show']);
    Route::post('/categories', [CategoryController::class, 'create'])->name('createCategory');
    Route::delete('/categories/{id}', [CategoryController::class, 'delete'])->name('deleteCategory');
});

// Super Admin Routes
Route::middleware('can:super-admin')->group(function () {
    Route::get('/admins', [AdminController::class, 'show']);
    Route::patch('/admins/{id}', [AdminController::class, 'toggleAdmin'])->name('toggleAdmin');
});
