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
Route::resource('tasks', TaskAPIController::class);
