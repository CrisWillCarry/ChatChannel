<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/ext/chatusers', [PageController::class, 'setChatUser']);
Route::post('/ext/messages', [PageController::class, 'setMessage']);

Route::get('/ext/chatusers', [PageController::class, 'getChatUsers']);
Route::get('/ext/messages', [PageController::class, 'getMessages']);

Route::get('/ext/chatusers/{id}', [PageController::class, 'getChatUserById']);
Route::get('/ext/messages/{id}', [PageController::class, 'getMessageById']);

Route::get('/ext/messages/{senderId}/{receiverId}', [PageController::class, 'getMessageBySenderIdAndReceiverId']);

Route::delete('/ext/chatusers/{id}', [PageController::class, 'deleteChatUser']);
Route::delete('/ext/messages/{id}', [PageController::class, 'deleteMessage']);
Route:: delete('/ext/messages',[PageController::class, 'deleteMessages']);