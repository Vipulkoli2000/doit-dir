<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Api\ProjectsController;
use App\Http\Controllers\Api\TaskSubmissionsController;
use App\Http\Controllers\Api\RolesPermissionsController;
use App\Http\Controllers\Api\FetchUserController;
 
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware'=>['auth:sanctum', 'permission']], function(){
   Route::get('/permissions', [RolesPermissionsController::class, 'index'])->name('permissions.index');
   Route::resource('taskSubmissions', TaskSubmissionsController::class);
  

});
Route::get('/files/{files}', [TaskSubmissionsController::class, 'showFiles'])->name("show.files");
Route::resource('tasks', TasksController::class);
Route::get('/users', [FetchUserController::class, 'index']);
Route::delete('/users/{id}', [UserController::class, 'deleteUser']);
Route::resource('projects', ProjectsController::class);