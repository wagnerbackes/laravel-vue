<?php

use App\Http\Controllers\api\Auth;
use App\Http\Controllers\api\CourseController;
use App\Http\Controllers\api\TopicController;
use App\Http\Controllers\api\LessonController;
use App\Http\Controllers\api\EnrollmentController;
use App\Http\Controllers\api\LessonProgressController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

// Rotas públicas para autenticação e registro
Route::post('/auth', [Auth::class, 'auth']);
Route::post('/register', [UserController::class, 'store']);
Route::get('/auth/verify', [Auth::class, 'verify'])->middleware('auth:sanctum');

// Rotas protegidas para usuários autenticados
Route::middleware(['auth:sanctum'])->group(function () {
    // Rotas para cursos
    Route::apiResource('courses', CourseController::class);

    // Rotas para tópicos aninhados em cursos
    Route::apiResource('courses.topics', TopicController::class);

    // Rotas para lições aninhadas em tópicos
    Route::apiResource('topics.lessons', LessonController::class);

    // Rotas para matrículas aninhadas em cursos
    Route::apiResource('courses.enrollments', EnrollmentController::class);

    // Rotas para progresso de lições
    Route::apiResource('lessons.progress', LessonProgressController::class);

    // Rota para obter dados do usuário autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Rota para logout
    Route::post('/logout', [Auth::class, 'logout']);
});
