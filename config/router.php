<?php
declare(strict_types=1);

namespace config\router;

/**
 * Execute action function and pass params.
 *
 * @param array $route
 * @param ...$params
 * @return void
 */
function execute_route(array $route, ...$params) : void
{
    $action_array = parse_route_action($route['to']);
    require_once __DIR__ . '/../app/controllers/' . $action_array[0] . '.php';
    $func = 'app\\controllers\\' . $action_array[0] . '\\' . $action_array[1];
    $func(...$params);
    die();
}

/**
 * Verify if route uri is compatible with actual uri.
 *
 * @param string $route_uri
 * @return boolean
 */
function is_compatible(string $route_uri) : bool
{
    return false;
}

/**
 * Check if $word have '{ }' at least ONE time.
 *
 * @param string $word
 * @return boolean
 */
function need_params(string $word) : bool
{
    return (bool) preg_match('/([\{\}])/', $word);
}

/**
 * Split route action on '#'.
 *
 * @param string $route_action
 * @return array
 */
function parse_route_action(string $route_action) : array
{
    return explode('#', $route_action, 2);
}