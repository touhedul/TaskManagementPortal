<?php

use API\EmployeeAPIController;
use API\TaskAPIController;
use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('employees/{id}', [App\Http\Controllers\API\EmployeeAPIController::class, 'update']);
Route::resource('employees', EmployeeAPIController::class);

// Route::post('tasks/{id}', [App\Http\Controllers\API\TaskAPIController::class, 'update']);
Route::get('tasks/employee/{employeeId}', [App\Http\Controllers\API\TaskAPIController::class, 'taskByEmployee']);

Route::get('tasks/todo/{employeeId}', [App\Http\Controllers\API\TaskAPIController::class, 'todo']);
Route::get('tasks/doing/{employeeId}', [App\Http\Controllers\API\TaskAPIController::class, 'doing']);
Route::get('tasks/complete/{employeeId}', [App\Http\Controllers\API\TaskAPIController::class, 'complete']);

Route::post('tasks/change-status/{id}/{status}', [App\Http\Controllers\API\TaskAPIController::class, 'changeStatus']);
Route::resource('tasks', TaskAPIController::class);
