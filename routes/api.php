<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// api for Tasks 
Route::get('tasks','Api\TaskController@index');
Route::get('task_find/{id}','Api\TaskController@taskByid');
Route::post('add_task','Api\TaskController@store');
Route::delete('tasks_delete/{id}','Api\TaskController@destroy');
Route::put('tasks_update/{id}','Api\TaskController@update');

//api for assgining tasks
Route::post('assign_new_task','Api\TaskController@assigntask');
Route::get('show_all_assigned_tasks','Api\TaskController@getAssignedTasks');//show assingned tasks with users etc "join multipule tables"
Route::get('find_assinged_task/{id}','Api\TaskController@findAssingedTask');
Route::put('assinged_task_update/{id}','Api\TaskController@updateAssingedTask');
Route::put('update_assigned_task_status/{id}','Api\TaskController@updateAssingedTaskStatus');//updating assigned task STATUS
Route::delete('destroy_assinged_task/{id}','Api\TaskController@destroyAssingedTask');

// api for user 
Route::get('users','Api\UserController@index');
Route::post('add_user','Api\UserController@store');
Route::delete('user_delete/{id}','Api\UserController@destroy');
Route::put('user_update/{id}','Api\UserController@update');







