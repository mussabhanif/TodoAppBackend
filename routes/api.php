<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/todos', [TodoController::class, 'getTodos']);
Route::post('/todos/create', [TodoController::class, 'createTodo']);
Route::post('/todos/update/{id}', [TodoController::class, 'updateTodo']);
Route::put('/todos/complete/{id}', [TodoController::class, 'completeTodo']);
Route::delete('/todos/delete/{id}', [TodoController::class, 'deleteTodo']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

