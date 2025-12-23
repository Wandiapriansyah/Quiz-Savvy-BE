<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Category;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizCategoryController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RecapJawabanController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('roles', RoleController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('quiz', QuizController::class);
Route::apiResource('categories', Category::class);
Route::apiResource('quiz-categories', QuizCategoryController::class);
Route::apiResource('questions', QuestionController::class);
Route::apiResource('answers', AnswerController::class);
Route::apiResource('results', ResultController::class);
Route::apiResource('recap-jawaban', RecapJawabanController::class);
Route::post('edit-questions/{quizId}', [QuestionController::class, 'update']);
Route::post('edit-answers/{quizId}', [AnswerController::class, 'update']);
Route::post('edit-title/{quizId}', [QuizController::class, 'update']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('questions-with-answers/{quiz_id}', [QuestionController::class, 'getQuestionWithAnswers']);
Route::get('myQuiz', [QuizController::class, 'createdBy']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});
