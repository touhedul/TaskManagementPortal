<?php


// Employee Routes
Route::post('employees/{id}', [App\Http\Controllers\API\EmployeeAPIController::class, 'update']);
Route::resource('employees', App\Http\Controllers\API\EmployeeAPIController::class);

// Task Routes
Route::get('tasks/employee/{employeeId}', [App\Http\Controllers\API\TaskAPIController::class, 'taskByEmployee']);
Route::post('tasks/change-status/{id}/{status}', [App\Http\Controllers\API\TaskAPIController::class, 'changeStatus']);
Route::resource('tasks',  App\Http\Controllers\API\TaskAPIController::class);
