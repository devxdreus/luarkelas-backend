<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------|
|                                   API Routes                             |
|--------------------------------------------------------------------------|
 */

Route::group(["prefix" => "/"], function () {
    Route::get('', [AuthController::class, 'index']);

    /*
    |--------------------------------------------------------------------------|
    |                               Auth Routes                             |
    |--------------------------------------------------------------------------|
     */
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::delete("logout", [AuthController::class, "logout"])->middleware("auth:sanctum");
    Route::get("me", [AuthController::class, "me"])->middleware("auth:sanctum");
    Route::get("auth/google", [AuthController::class, "redirectToGoogle"]);
    Route::get("auth/google/callback", [AuthController::class, "handleGoogleCallback"]);

    /*
    |--------------------------------------------------------------------------|
    |                               Users Routes                               |
    |--------------------------------------------------------------------------|
     */
    Route::middleware("auth:sanctum")->group(function () {
        Route::get('users', [UserController::class, 'index']);
        Route::get('user/{id}', [UserController::class, 'show']);
        Route::put('user/{id}', [UserController::class, 'update']);
    });

    /*
    |--------------------------------------------------------------------------|
    |                               Reports Routes                             |
    |--------------------------------------------------------------------------|
     */
    Route::middleware("auth:sanctum")->group(function () {
        Route::get('reports', [ReportController::class, 'index']);
        Route::get('report/{id}', [ReportController::class, 'show']);
        Route::post("report", [ReportController::class, "store"]);
        Route::put("report/{id}", [ReportController::class, "update"]);
        Route::delete("report/{id}", [ReportController::class, "destroy"]);
    });

    /*
    |--------------------------------------------------------------------------|
    |                               Student Routes                             |
    |--------------------------------------------------------------------------|
     */
    Route::middleware("auth:sanctum")->group(function () {
        Route::get('students', [StudentController::class, 'index']);
        Route::get('student/{id}', [StudentController::class, 'show']);
        Route::put('student/{id}', [StudentController::class, 'update']);
        Route::delete('student/{id}', [StudentController::class, 'destroy']);

    });
    /*
    |--------------------------------------------------------------------------|
    |                               Teacher Routes                             |
    |--------------------------------------------------------------------------|
     */
    Route::middleware("auth:sanctum")->group(function () {
        Route::get('teachers', [TeacherController::class, 'index']);
        Route::get('teacher/{id}', [TeacherController::class, 'show']);
        Route::post('teacher', [TeacherController::class, 'store']);
        Route::put('teacher/{id}', [TeacherController::class, 'update']);
        Route::delete('teacher/{id}', [TeacherController::class, 'destroy']);

    });

    /*
    |--------------------------------------------------------------------------|
    |                               Admin  Routes                              |
    |--------------------------------------------------------------------------|
     */
    Route::middleware("auth:sanctum")->group(function () {
        Route::get('new-students', [AdminController::class, 'newStudents']);
        Route::post('add-students', [AdminController::class, 'addStudent']);
        Route::put('update-student/{id}', [AdminController::class, 'updateStudent']);
    });
});
