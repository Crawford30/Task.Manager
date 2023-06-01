<?php

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


Route::middleware([ 'auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'Api', 'middleware' => 'return-json'], function () {

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register-user', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');




});





Route::group(['middleware' => ['auth:api']], function () {

    //============Task Manager ======
    Route::group(['prefix' => 'task'], function () {
        Route::get('/list', [App\Http\Controllers\Api\TaskController::class, 'getAllTasks']);
        Route::post('/create-task', [App\Http\Controllers\Api\TaskController::class, 'saveTaskData']);
        Route::post('/delete-task', [App\Http\Controllers\Api\TaskController::class, 'deleteTaskData']);
      });


      Route::group(['prefix' => 'project'], function () {
        Route::get('/list', [App\Http\Controllers\Api\ProjectController::class, 'getAllProjects']);
      });





  });

});
