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

Route::post('login', 'API\AuthController@login');
//Route::post('register', 'API\AuthController@register');
//Route::post('projects/info', 'API\ProjectsController@getInfo');
//Route::post('projects/all', 'API\ProjectsController@getProjects');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
Route::middleware('auth:api')->group(function () {
    Route::post('getAllBlockPersons', 'API\ProjectApiController@getAllBlockPersons');//
    Route::post('myProjects', 'API\ProjectApiController@userProjects');//
    Route::post('attendence', 'API\ProjectApiController@attendences');//
    Route::post('getAllUserTasks', 'API\ProjectApiController@getAllUserTasks');//
    Route::post('changeTaskStatusByManager', 'API\ProjectApiController@changeTaskStatusByManager');//
    Route::post('changeTaskStatusByStaff', 'API\ProjectApiController@changeTaskStatusByStaff');//


    Route::post('userInfo', 'API\AuthController@userInfo');//

});

