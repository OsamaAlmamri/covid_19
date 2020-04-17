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
Route::post('register', 'API\AuthController@register');
Route::post('projects/info', 'API\ProjectsController@getInfo');
Route::post('projects/all', 'API\ProjectsController@getProjects');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
Route::middleware('auth:api')->group(function () {
    Route::post('myTasks', 'API\ProjectsController@userTasks');//
    Route::post('myProjects', 'API\ProjectsController@userProjects');//
    Route::post('attendence', 'API\ProjectsController@attendences');//
    Route::post('getAllUserTasks', 'API\ProjectsController@getAllUserTasks');//
    Route::post('changeTaskStatusByManager', 'API\ProjectsController@changeTaskStatusByManager');//
    Route::post('changeTaskStatusByStaff', 'API\ProjectsController@changeTaskStatusByStaff');//


    Route::post('userInfo', 'API\AuthController@userInfo');//
    Route::post('orders/search', 'API\OrdersController@search');//
    Route::post('orders/store', 'API\OrdersController@store');//
    Route::post('orders/get', 'API\OrdersController@index');//
    Route::post('getMyAddress', 'API\ZonesController@getMyAddress');//
    Route::post('address/store', 'API\ZonesController@store');//
    Route::post('address/update', 'API\ZonesController@update');//
    Route::post('address/delete', 'API\ZonesController@delete');//
    Route::post('orders/truckOrder', 'API\OrdersController@truckOrder');//
    Route::post('orders/ConfirmOrder', 'API\OrdersController@ConfirmOrder');//
    Route::post('orders/CancelOrder', 'API\OrdersController@CancelOrder');//
//    Route::post('sql', 'API\AuthController@sql');
});

