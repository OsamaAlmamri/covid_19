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


Route::get('login', function () {

    return view('auth.login');

})->name('login');

Route::post('postLogin', "Auth\LoginController@postlogin")->name('postLogin');


//Route::get('/orders', 'HomeController@orders')->name('orders');

Route::group(['middleware' => 'auth'], function () {

    // any route here will only be accessible for logged in users
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index');
    Route::get('/404', 'HomeController@erroe404')->name('404');
    Route::get('users', 'UserController@index')->name('user');
    Route::any('logout', 'Auth\LoginController@logout')->name('logout');


    Route::get('profile', 'SettingController@profile')->name('profile');;
    Route::post('editProfile', 'SettingController@editProfile')->name('editProfile');;


    Route::get('lang/{lang}', function () {
        $lang = request('lang');
        session()->has('lang') ? session()->forget('lang') : '';
        $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');

        return back();
    })->name('lang');

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
    Route::post('zones/getZones', 'ZoneController@getZones')->name('zones.getZones');
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


    Route::get('check_points/index/{type?}', 'CheckPointController@index')->name('check_points.index');
    Route::get('check_points/{id}/forceDelete', 'CheckPointController@forceDelete')->name('check_points.forceDelete');
    Route::delete('check_points/deleteMulti', 'CheckPointController@deleteMulti');
    Route::get('check_points/{id}/delete', 'CheckPointController@delete')->name('check_points.delete');
    Route::get('check_points/{id}/restore', 'CheckPointController@restore')->name('check_points.restore');
    Route::post('check_points/active', 'CheckPointController@active')->name('check_points.active');
    Route::get('check_points/{id}/{type}/team', 'CheckPointController@team')->name('check_points.team');
    Route::get('check_points/show_teams', 'PointTeamController@index')->name('check_points.team.show');
    Route::get('workTeams/show_teams/{type?}/{id?}', 'PointTeamController@index')->name('workTeams.team.show');
    Route::get('check_points/team/{id}/create', 'PointTeamController@create')->name('check_points.team.create');
    Route::resource('check_points', 'CheckPointController')->except('index');

    Route::post('check_points/filterPlace_type', 'PointTeamController@filterPlace_type')->name('check_points.filterPlace_type');
    Route::post('check_points/changePointOrCenter', 'PointTeamController@changePointOrCenter')->name('check_points.changePointOrCenter');
    Route::post('check_points/savePointTeamList', 'PointTeamController@savePointTeamList')->name('check_points.savePointTeamList');
    Route::get('check_points/showOrdersDisputes/{type?}', 'PointTeamController@showOrdersDisputes')->name('check_points.showOrdersDisputes');
    Route::post('check_points/filterTeam', 'PointTeamController@filterTeamWorker')->name('check_points.filterTeam');

    Route::get('block_persons/index/{type?}', 'BlockPersonsController@index')->name('block_persons.index');
    Route::get('block_persons/sumBlockPersonsAccordingForCenterData/{type?}', 'BlockPersonsController@sumBlockPersonsAccordingForCenterData')->name('block_persons.sumBlockPersonsAccordingForCenterData');
    Route::post('block_persons/filterBlockPersons', 'BlockPersonsController@filterBlockPersons')->name('block_persons.filterBlockPersons');


    Route::get('quarantineTypes/{id}/delete', 'QuarntineTypesController@delete')->name('quarantineTypes.delete');
    Route::resource('quarantineTypes', 'QuarntineTypesController');

    Route::get('workTeams/{id}/forceDelete', 'WorkTeamsController@forceDelete')->name('workTeams.forceDelete');
    Route::get('workTeams/{id}/delete', 'WorkTeamsController@delete')->name('workTeams.delete');
    Route::get('workTeams/{id}/restore', 'WorkTeamsController@restore')->name('workTeams.restore');
    Route::post('workTeams/active', 'WorkTeamsController@active')->name('workTeams.active');
    Route::post('workTeams/remove', 'WorkTeamsController@remove')->name('workTeams.remove');
    Route::post('workTeams/changeStatus', 'WorkTeamsController@changeStatus')->name('workTeams.changeStatus');
    Route::get('workTeams/showAll/{type?}', 'WorkTeamsController@index')->name('workTeams.showAll');
//Route::get('workTeams/showAll/{type?}',function (){
//    return dd('d');
//})->name('workTeams.showAll');

    Route::resource('workTeams', 'WorkTeamsController');

    Route::get('healthTeams/{id}/forceDelete', 'TasksController@forceDelete')->name('healthTeams.forceDelete');
    Route::get('healthTeams/{id}/delete', 'TasksController@delete')->name('healthTeams.delete');
    Route::get('healthTeams/{id}/restore', 'TasksController@restore')->name('healthTeams.restore');
    Route::post('healthTeams/active', 'TasksController@active')->name('healthTeams.active');
    Route::post('healthTeams/getTaskDeatial', 'TasksController@getTaskDeatial')->name('healthTeams.getTaskDeatial');
    Route::post('healthTeams/remove', 'TasksController@remove')->name('healthTeams.remove');
    Route::post('healthTeams/changeStatus', 'TasksController@changeStatus')->name('healthTeams.changeStatus');
    Route::resource('healthTeams', 'TasksController')->except('index');


});
