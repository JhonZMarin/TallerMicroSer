<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\PrioridadController;
use App\Http\Controllers\TareaController;

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return '¡Bienvenido a mi aplicación!';
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'empleados'], function () use ($router) {
        $router->get('/', 'EmpleadoController@index');
        $router->get('/{id}', 'EmpleadoController@show');
        $router->post('/', 'EmpleadoController@store');
        $router->put('/{id}', 'EmpleadoController@update');
        $router->delete('/{id}', 'EmpleadoController@destroy');
    });

    $router->group(['prefix' => 'estados'], function () use ($router) {
        $router->get('/', 'EstadoController@index');
        $router->get('/{id}', 'EstadoController@show');
        $router->post('/', 'EstadoController@store');
        $router->put('/{id}', 'EstadoController@update');
        $router->delete('/{id}', 'EstadoController@destroy');
    });

    $router->group(['prefix' => 'prioridades'], function () use ($router) {
        $router->get('/', 'PrioridadController@index');
        $router->get('/{id}', 'PrioridadController@show');
        $router->post('/', 'PrioridadController@store');
        $router->put('/{id}', 'PrioridadController@update');
        $router->delete('/{id}', 'PrioridadController@destroy');
    });

    $router->group(['prefix' => 'tareas'], function () use ($router) {
        $router->get('/', 'TareaController@index');
        $router->get('/{id}', 'TareaController@show');
        $router->post('/', 'TareaController@store');
        $router->put('/{id}', 'TareaController@update');
        $router->delete('/{id}', 'TareaController@destroy');
    });
});
