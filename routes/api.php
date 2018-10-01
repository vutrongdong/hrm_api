<?php

/*
|--------------------------------------------------------------------------
| Common api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->group(['middleware' => 'auth'], function ($router) {
    resource('/users', 'UserController', $router);

    $router->get('/profile', 'ProfileController@index');
    $router->put('/profile', 'ProfileController@update');
    $router->put('/profile/change-password', 'ProfileController@changePassword');
    $router->get('/permissions', 'PermissionController@index');
    resource('/roles', 'RoleController', $router);

    // $router->get('/cities', 'CityController@index');
    $router->get('/districts', 'DistrictController@index');
    resource('/cities', 'CityController', $router);
    // resource('/districts', 'DistrictController', $router);
    
    $router->get('/wards', 'WardController@index');

    resource('/settings', 'SettingController', $router);
    
    resource('/branches', 'BranchController', $router);
    resource('/departments', 'DepartmentController', $router);
    $router->get('/departments/branches/{id}', 'DepartmentController@getByBranch');
    $router->get('/districts/cities/{id}', 'DistrictController@getByCity');
    resource('/positions', 'PositionController', $router);
    resource('/contracts', 'ContractController', $router);
    // resource('/contract_users', 'ContractUserController', $router);
    resource('/plans', 'PlanController', $router);
    resource('/candidates', 'CandidateController', $router);
    resource('/plan_details', 'PlanDetailController', $router);

    $router->put('/users/change-status/{id}', 'UserController@changeStatus');
    $router->put('/branches/change-status/{id}', 'BranchController@changeStatus');
    $router->put('/settings/change-status/{id}', 'SettingController@changeStatus');
    $router->put('/departments/change-status/{id}', 'DepartmentController@changeStatus');
    $router->put('/positions/change-status/{id}', 'PositionController@changeStatus');
});


$router->post('login', 'LoginController@login');
$router->post('register', 'RegisterController@register');




/**
 * resource router helper
 * @author KingDarkness <nguyentranhoan13@gmail.com>
 * @date   2018-07-17
 * @param  string     $uri        enpoint url
 * @param  string     $controller controller name
 * @param  Laravel\Lumen\Routing\Router     $router     RouterObject
 */
function resource($uri, $controller, Laravel\Lumen\Routing\Router $router)
{
    $router->get($uri, $controller.'@index');
    $router->get($uri.'/{id}', $controller.'@show');
    $router->post($uri, $controller.'@store');
    $router->put($uri.'/{id}', $controller.'@update');
    $router->delete($uri.'/{id}', $controller.'@destroy');
}
