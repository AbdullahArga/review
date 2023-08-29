<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\NotificationContrlloer;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/register', [AuthController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'loginUser']);

Route::middleware(['auth:sanctum'])->group(function () {
    // notes
   Route::post('notes',[NoteController::class, 'store']);
   Route::put('notes/{note}',[NoteController::class, 'update']);
   Route::delete('notes',[NoteController::class, 'delete']);
   Route::get('notes',[NoteController::class, 'index']);
   Route::get('notes/public',[NoteController::class, 'publicNotes']);
   Route::get('notes/{note}',[NoteController::class, 'edit']);

   //notification
   Route::get('notifications',[NotificationController::class, 'notifications']);
   Route::post('notifications/mark-as-read/{id}',[NotificationController::class, 'markAsRead']);
   Route::delete('notifications/{id}',[NotificationController::class, 'delete']);

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

