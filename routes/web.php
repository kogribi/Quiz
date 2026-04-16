<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quiz', [TopicController::class, "index"])->middleware(['auth', 'verified'])->name('quiz');
Route::get('/quiz/create', [TopicController::class, 'create'])->middleware(['auth', 'verified', 'can:admin'])->name('quiz.create');
Route::post('/quiz', [TopicController::class, 'store'])->middleware(['auth', 'verified', 'can:admin']);
Route::get('/quiz/{topic}', [TopicController::class, "show"])->middleware(['auth', 'verified'])->name('quiz.show');
Route::post('/quiz/{topic}/answer', [TopicController::class, 'answer'])->middleware(['auth', 'verified'])->name('quiz.answer');

Route::post('/question', [QuestionController::class, 'store'])->middleware(['auth', 'verified', 'can:admin']);

Route::post('/answer', [AnswerController::class, 'store'])->middleware(['auth', 'verified', 'can:admin']);





Route::get('/history', [ResultController::class, "index"])->middleware(['auth', 'verified'])->name('history');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
