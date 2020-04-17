<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('login', "Auth\LoginController@login")->name('login');
Route::post('postLogin', "Auth\LoginController@postlogin")->name('postLogin');

Route::get('register', "Auth\LoginController@register");
Route::post('register', "Auth\RegisterController@create");
Route::get('users', 'UserController@index')->name('user');
Route::any('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/404', 'HomeController@erroe404')->name('404');
//Route::get('/orders', 'HomeController@orders')->name('orders');
Route::get('profile', 'HomeController@profile')->name('profile');
Route::post('change_image', 'HomeController@change_image')->name('change_image');
Route::post('changeProfile_info', 'HomeController@changeProfile_info')->name('changeProfile_info');
Route::post('changePassword', 'HomeController@changePassword')->name('changePassword');
Route::post('setting/changeSetting', 'SettingController@changeSetting')->name('changeSetting');
Route::get('makeAllNotificationRead', function () {
    auth()->guard(get_guard_name())->user()->unreadNotifications->markAsRead();
    return back();
})->name('makeAllNotificationRead');;

Route::get('lang/{lang}', function () {
    $lang = request('lang');
    session()->has('lang') ? session()->forget('lang') : '';
    $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');

    return back();
})->name('lang');


Route::get('profile', 'SettingController@profile')->name('profile');;
Route::post('editProfile', 'SettingController@editProfile')->name('editProfile');;
Route::get('makeAllNotificationRead', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('makeAllNotificationRead');;
//Route::get('settings', 'SettingController@settings')->name('settings');;
Route::get('settings', 'HomeController@index')->name('settings');;
Route::post('settings', 'SettingController@settings_store')->name('settings.store');;
Route::post('setting/add', 'SettingController@AccountSettingStore')->name('accsetting.store');;



Route::get('permissions/index/{section_id?}', 'PermissionsController@index')->name('permissions.index');
Route::post('permissions/open', 'PermissionsController@open')->name('permissions.open');
Route::post('permissions/updateMulti', 'PermissionsController@updateMulti')->name('permissions.updateMulti');
Route::post('permissions/storeMulti', 'PermissionsController@storeMulti')->name('permissions.storeMulti');
Route::resource('permissions', 'PermissionsController')->except('index');



Route::get('users/index/{type?}', 'UserController@index')->name('users.index');
Route::get('users/{id}/forceDelete', 'UserController@forceDelete')->name('users.forceDelete');
Route::get('users/{id}/permissions', 'UserController@permissions')->name('users.permissions');
Route::delete('users/deleteMulti', 'UserController@deleteMulti');
Route::get('users/{id}/delete', 'UserController@delete')->name('users.delete');
Route::post('users/{id}/updatePermissions', 'UserController@updatePermissions')->name('users.updatePermissions');
Route::get('users/{id}/restore', 'UserController@restore')->name('users.restore');
Route::post('users/active', 'UserController@active')->name('users.active');
Route::resource('users', 'UserController')->except('index');


Route::get('projects/index/{type?}', 'ProjectsController@index')->name('projects.index');
Route::get('projects/{id}/forceDelete', 'ProjectsController@forceDelete')->name('projects.forceDelete');
Route::delete('projects/deleteMulti', 'ProjectsController@deleteMulti');
Route::get('projects/{id}/delete', 'ProjectsController@delete')->name('projects.delete');
Route::get('projects/{id}/restore', 'ProjectsController@restore')->name('projects.restore');
Route::post('projects/active', 'ProjectsController@active')->name('projects.active');
Route::post('projects/team', 'ProjectsController@team')->name('projects.team');
Route::get('projects/team/{id}/show', 'TeamsController@index')->name('projects.team.showTable');
Route::get('projects/team/{id}/create', 'TeamsController@create')->name('projects.team.create');
Route::resource('projects', 'ProjectsController')->except('index');


Route::get('zones/deleted', 'ZoneController@deleted')->name('zones.deleted');
Route::get('zones/index/{zone?}/{type?}', 'ZoneController@index')->name('zones.index');
Route::get('zones/{zone}/create', 'ZoneController@create')->name('zones.create');
Route::get('zones/{id}/forceDelete', 'ZoneController@forceDelete')->name('zones.forceDelete');
Route::delete('zones/deleteMulti', 'ZoneController@deleteMulti');
Route::get('zones/{id}/delete', 'ZoneController@delete')->name('zones.delete');
Route::get('zones/{id}/restore', 'ZoneController@restore')->name('zones.restore');
Route::post('zones/active', 'ZoneController@active')->name('zones.active');
Route::post('zones/getZones', 'ZoneController@getZones')->name('zones.getZones ');
Route::resource('zones', 'ZoneController')->except('index', 'create');





Route::get('quarantines/index/{type?}', 'QuarantinesController@index')->name('quarantines.index');
Route::get('quarantines/{id}/forceDelete', 'QuarantinesController@forceDelete')->name('quarantines.forceDelete');
Route::delete('quarantines/deleteMulti', 'QuarantinesController@deleteMulti');
Route::get('quarantines/{id}/delete', 'QuarantinesController@delete')->name('quarantines.delete');
Route::get('quarantines/{id}/restore', 'QuarantinesController@restore')->name('quarantines.restore');
Route::post('quarantines/active', 'QuarantinesController@active')->name('quarantines.active');
Route::post('quarantines/team', 'QuarantinesController@team')->name('quarantines.team');
Route::get('quarantines/team/{id}/show', 'TeamsController@index')->name('quarantines.team.showTable');
Route::get('quarantines/team/{id}/create', 'TeamsController@create')->name('quarantines.team.create');
Route::resource('quarantines', 'QuarantinesController')->except('index');


Route::get('tasks/table/{user?}/{type?}', 'TasksController@index')->name('tasks.table');
Route::get('tasks/{id}/forceDelete', 'TasksController@forceDelete')->name('tasks.forceDelete');
Route::delete('tasks/deleteMulti', 'TasksController@deleteMulti');
Route::get('tasks/{id}/delete', 'TasksController@delete')->name('tasks.delete');
Route::get('tasks/{id}/restore', 'TasksController@restore')->name('tasks.restore');
Route::post('tasks/active', 'TasksController@active')->name('tasks.active');
Route::post('tasks/getTaskDeatial', 'TasksController@getTaskDeatial')->name('tasks.getTaskDeatial');
Route::post('tasks/remove', 'TasksController@remove')->name('tasks.remove');
Route::post('tasks/member', 'TasksController@member')->name('tasks.member');
Route::post('tasks/changeStatus', 'TasksController@changeStatus')->name('tasks.changeStatus');
Route::get('tasks/{project}/{user}/staff', 'TasksController@staffTasks')->name('tasks.staffTasks');
Route::resource('tasks', 'TasksController')->except('index');

Route::get('phases/index/{type?}', 'PhasesController@index')->name('phases.index');
Route::get('phases/{id}/forceDelete', 'PhasesController@forceDelete')->name('phases.forceDelete');
Route::delete('phases/deleteMulti', 'PhasesController@deleteMulti');
Route::get('phases/{id}/delete', 'PhasesController@delete')->name('phases.delete');
Route::get('phases/{id}/restore', 'PhasesController@restore')->name('phases.restore');
Route::post('phases/active', 'PhasesController@active')->name('phases.active');
Route::post('phases/getPhaseDeatial', 'PhasesController@getPhaseDeatial')->name('phases.getPhaseDeatial');
Route::post('phases/remove', 'PhasesController@remove')->name('phases.remove');
Route::resource('phases', 'PhasesController')->except('index');

Route::get('daysQrs/index/{type?}', 'UserController@index')->name('daysQrs.index');
Route::get('daysQrs/{id}/forceDelete', 'UserController@forceDelete')->name('daysQrs.forceDelete');
Route::get('daysQrs/{id}/permissions', 'UserController@permissions')->name('daysQrs.permissions');
Route::delete('daysQrs/deleteMulti', 'UserController@deleteMulti');
Route::get('daysQrs/{id}/delete', 'UserController@delete')->name('daysQrs.delete');
Route::get('daysQrs/{id}/restore', 'UserController@restore')->name('daysQrs.restore');
Route::post('daysQrs/active', 'UserController@active')->name('daysQrs.active');
Route::resource('daysQrs', 'UserController')->except('index');

Route::get('attendences/index/{type?}', 'AttendencesController@index')->name('attendences.index');
Route::resource('attendences', 'UserController')->except('index');

Route::get('periods/index/{type?}', 'UserController@index')->name('periods.index');
Route::get('periods/{id}/forceDelete', 'UserController@forceDelete')->name('periods.forceDelete');
Route::get('periods/{id}/permissions', 'UserController@permissions')->name('periods.permissions');
Route::delete('periods/deleteMulti', 'UserController@deleteMulti');
Route::get('periods/{id}/delete', 'UserController@delete')->name('periods.delete');
Route::get('periods/{id}/restore', 'UserController@restore')->name('periods.restore');
Route::post('periods/active', 'UserController@active')->name('periods.active');
Route::resource('periods', 'UserController')->except('index');
