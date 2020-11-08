<?php

$routes = [

    ['method' => 'GET', 'uri' => '/', 'to' => 'user_controller#index', 'middleware' => 'auth'],
    ['method' => 'GET', 'uri' => '/users/{id}', 'to' => 'user_controller#show'],
    ['method' => 'GET', 'uri' => '/hello/{name}', 'to' => 'user_controller#hello'],

];

return $routes;