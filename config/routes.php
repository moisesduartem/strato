<?php

use function config\router\get;
use function config\router\post;
use function config\router\put;
use function config\router\delete;

$routes = [

    get('/', 'user_controller#index', 'auth'),
    get('/users/{id}', 'user_controller#show'),
    get('/hello/{name}', 'user_controller#hello')

];

return $routes;