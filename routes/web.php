<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get("/", function () use ($router) {
    return $router->app->version();
});

$router->group(["prefix" => "api"], function() use ($router) {

    $router->get("/", "ClubeController@index");
    $router->post("clube", "ClubeController@save");
    $router->get("clube", "ClubeController@getAll");
    $router->get("clube/{id}", "ClubeController@getById");
    $router->put("clube/{id}", "ClubeController@update");
    $router->delete("clube/{id}", "ClubeController@delete");

    $router->post("socio", "SocioController@save");
    $router->get("socio", "SocioController@getAll");
    $router->get("socio/{id}", "SocioController@getById");
    $router->put("socio/{id}", "SocioController@update");
    $router->delete("socio/{id}", "SocioController@delete");

    $router->post("socioclube", "SocioClubeController@save");
    $router->get("socioclube", "SocioClubeController@get");
});

