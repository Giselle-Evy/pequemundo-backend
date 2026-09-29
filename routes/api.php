<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChildProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\Api\Admin\SubjectController as AdminSubjectController;
use App\Http\Controllers\Api\Admin\ExerciseController as AdminExerciseController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use App\Http\Controllers\StoreController;

// Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);

    // Suscripciones
    Route::get('/subscription/status', [App\Http\Controllers\SubscriptionController::class, 'status']);
    Route::post('/subscription/checkout', [App\Http\Controllers\SubscriptionController::class, 'checkout']);
    Route::get('/subscription/portal', [App\Http\Controllers\SubscriptionController::class, 'portal']);

    // Tienda (ver items siempre permitido)
    Route::get('/store/items', [StoreController::class, 'index']);

    // Perfiles de niños (ver siempre permitido)
    Route::get('/children', [ChildProfileController::class, 'index']);

    // Materias (ver siempre permitido)
    Route::get('/subjects', [SubjectController::class, 'index']);
    Route::get('/subjects/{id}', [SubjectController::class, 'show']);

    // Ejercicios (ver siempre permitido)
    Route::get('/subjects/{id}/exercises', [ExerciseController::class, 'bySubject']);
    Route::get('/exercises/{id}', [ExerciseController::class, 'show']);

    // Progreso (ver siempre permitido)
    Route::get('/children/{id}/progress', [ProgressController::class, 'show']);
    Route::get('/children/{id}/history', [ProgressController::class, 'history']);

    // Logros (ver siempre permitido)
    Route::get('/achievements', [AchievementController::class, 'all']);
    Route::get('/children/{id}/achievements', [AchievementController::class, 'show']);

    // Ranking (ver siempre permitido)
    Route::get('/rankings', [RankingController::class, 'global']);
    Route::get('/rankings/family', [RankingController::class, 'family']);

    // === RUTAS QUE REQUIEREN SUSCRIPCIÓN O EJERCICIOS GRATIS ===
    Route::middleware('subscribed')->group(function () {
        // Respuestas (jugar ejercicio)
       Route::post('/exercises/{id}/answer', [AnswerController::class, 'answer']);

        // Tienda (comprar/equipar)
        Route::post('/store/buy', [StoreController::class, 'buy']);
        Route::post('/store/equip', [StoreController::class, 'equip']);
        Route::post('/store/unequip', [StoreController::class, 'unequip']);

        // Crear perfil nuevo
        Route::post('/children', [ChildProfileController::class, 'store']);
    });

    // === ADMIN ===
    Route::middleware('admin')->prefix('admin')->group(function () {
        // Materias
        Route::get('/subjects', [AdminSubjectController::class, 'index']);
        Route::post('/subjects', [AdminSubjectController::class, 'store']);
        Route::put('/subjects/{id}', [AdminSubjectController::class, 'update']);
        Route::delete('/subjects/{id}', [AdminSubjectController::class, 'destroy']);

        // Ejercicios
        Route::get('/exercises', [AdminExerciseController::class, 'index']);
        Route::post('/exercises', [AdminExerciseController::class, 'store']);
        Route::put('/exercises/{id}', [AdminExerciseController::class, 'update']);
        Route::delete('/exercises/{id}', [AdminExerciseController::class, 'destroy']);

        // Usuarios
        Route::get('/users', [AdminUserController::class, 'index']);
        Route::get('/users/{id}', [AdminUserController::class, 'show']);
    });
});