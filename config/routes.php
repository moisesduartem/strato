<?php

$routes = [

    ['method' => 'GET', 'uri' => '/', 'to' => 'user_controller#index', 'middleware' => 'auth'],
    ['method' => 'GET', 'uri' => '/hello/{name}', 'to' => 'user_controller#hello'],
    ['method' => 'GET', 'uri' => '/users/{id}/books/{id}', 'to' => 'user_controller#book'],

];

return $routes;