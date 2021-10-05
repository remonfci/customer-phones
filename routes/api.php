<?php

declare(strict_types=1);

/** @var \Laravel\Lumen\Routing\Router $router */
$router->group(['prefix' => 'customers'], function () use ($router) {
    $router->get('/', 'Api\CustomerController@index');
});

$router->group(['prefix' => 'countries'], function () use ($router) {
    $router->get('/', 'Api\CountryController@index');
});
