<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Announcement
Route::get('/announcements', [AnnouncementController::class, 'index']);

Route::get('/announcements-public', [AnnouncementController::class, 'index_public']);

Route::post('/create-announcement', [AnnouncementController::class, 'store']);

Route::get('/edit-announcement/{id}', [AnnouncementController::class, 'edit']);

Route::put('/update-announcement/{id}', [AnnouncementController::class, 'update']);

Route::delete('/delete-announcement/{id}', [AnnouncementController::class, 'destroy']);

// ----------------

Route::get('/users', [UserController::class, 'index']);

Route::delete('/delete-user/{id}', [UserController::class, 'destroy']);

// ----------------

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 
Route::post('/register',[UserController::class,'register']); // Signup URL 
Route::post('/login',[UserController::class,'login']); // Login URL
Route::post('/logout',[UserController::class,'logout']); // Logout URL


