<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\ExperienciaController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatController;



//Open Routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/loginRecruiter', [RecruiterController::class, 'login']);

Route::group([
    "middleware" => ['auth:sanctum']
], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/users/{userId}/chatsWithMessages', [UserController::class, 'chatsWithMessages']);
    Route::get('/users/{userId}/estudios', [UserController::class, 'showEstudios']);
    Route::get('/users/{userId}/experiencias', [UserController::class, 'showExperiencias']);
    Route::get('/users/{userId}/profile', [UserController::class, 'showUserProfile']);

    Route::get('/recruiters', [RecruiterController::class, 'index']);
    Route::post('/recruiters', [RecruiterController::class, 'store']);
    Route::get('/recruiters/{id}', [RecruiterController::class, 'show']);
    Route::put('/recruiters/{id}', [RecruiterController::class, 'update']);
    Route::delete('/recruiters/{id}', [RecruiterController::class, 'destroy']);

    Route::get('/works', [WorkController::class, 'index']);
    Route::post('/works', [WorkController::class, 'store']);
    Route::get('/works/{id}', [WorkController::class, 'show']);
    Route::put('/works/{id}', [WorkController::class, 'update']);
    Route::delete('/works/{id}', [WorkController::class, 'destroy']);
    Route::get('/works/{workId}/requests', [WorkController::class, 'getWorkRequests']);
    Route::get('/works/{recruiterId}/recruiter', [WorkController::class, 'getMyWorks']);

    Route::get('/requests', [RequestController::class, 'index']);
    Route::post('/requests', [RequestController::class, 'store']);
    Route::get('/requests/{id}', [RequestController::class, 'show']);
    Route::put('/requests/{id}', [RequestController::class, 'update']);
    Route::delete('/requests/{id}', [RequestController::class, 'destroy']);
    Route::get('/requests/{userId}/user', [RequestController::class, 'showRequests']);
    Route::get('/requests/{recruiterId}/recruiter', [RequestController::class, 'showWorks']);
    Route::put('/requests/{id}/status/{status}', [RequestController::class, 'changeStatus']);


    Route::get('/estudios', [EstudioController::class, 'index']);
    Route::post('/estudios', [EstudioController::class, 'store']);
    Route::get('/estudios/{estudio}', [EstudioController::class, 'show']);
    Route::put('/estudios/{estudio}', [EstudioController::class, 'update']);
    Route::delete('/estudios/{estudio}', [EstudioController::class, 'destroy']);

// Rutas para las experiencias
    Route::get('/experiencias', [ExperienciaController::class, 'index']);
    Route::post('/experiencias', [ExperienciaController::class, 'store']);
    Route::get('/experiencias/{experiencia}', [ExperienciaController::class, 'show']);
    Route::put('/experiencias/{experiencia}', [ExperienciaController::class, 'update']);
    Route::delete('/experiencias/{experiencia}', [ExperienciaController::class, 'destroy']);

    Route::get('/messages', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/messages/{id}', [MessageController::class, 'show']);
    // Add more routes as needed for updating and deleting messages

    // Routes for chats
    Route::get('/chats', [ChatController::class, 'index']);
    Route::post('/chats', [ChatController::class, 'store']);
    Route::get('/chats/{id}', [ChatController::class, 'show']);


}
);
