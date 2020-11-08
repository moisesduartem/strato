<?php
declare(strict_types=1);

/**
 * @author Moisés Mariano
 * @source github.com/moisesduartem
 */

namespace config\router;

use function config\helper\view;
use function config\request\get_uri;

/**
 * Execute action function and pass params.
 *
 * @param array $route
 * @param ...$params
 * @return void
 */
function execute_route(array $route, ...$params) : void
{
    /**
     * Checking middleware
     */
    if (isset($route['middleware']) && !empty($route['middleware'])) {
        require_once __DIR__ . '/../app/middlewares/' . $route['middleware'] . '.php';
        $middleware_func = 'app\\middlewares\\' . $route['middleware']. '\\' .$route['middleware']; 
        $middleware_func();
    }
    $action_array = parse_route_action($route['to']);
    require_once __DIR__ . '/../app/controllers/' . $action_array[0] . '.php';
    $func = 'app\\controllers\\' . $action_array[0] . '\\' . $action_array[1];
    $entity_name = str_replace('_controller', '', $action_array[0]) . 's';
    /**
     * Executing function, passing the params and
     * receiving data to be rendered.
     */
    $data = $func(...$params);
    /**
     * Let's suppose that the action is user_controller#index. Ok?
     * So, if the 'users/index.twig' view exists, the $data that was
     * returned from controller will be passed to this view, that
     * will be rendered. 
     */
    if (file_exists( __DIR__ . "/../app/views/$entity_name/$action_array[1].twig")) {
        view("$entity_name/$action_array[1]", $data ?? []);
    }
    die();
}

/**
 * Get parameters indexes from route uri;
 * @param string $route_uri
 * @return array
 */
function get_params_from_route(string $route_uri) : array
{
    /**
     * Split route uri with '/'
     */
    $splited_route_uri = explode('/', $route_uri);

    $params = [];
    /**
     * Run all/part/like/this from route uri
     */
    foreach($splited_route_uri as $key => $part) {
        /**
         * If in that parte have some '{',
         * needs a param!
         */
        if (strstr($part, '{')) {
            $params[] = $key - 1;
        }
    }
    return $params;
}

/**
 * Catch params from uri to return them on array
 * and in a future be passed to action. 
 *
 * @param string $route_uri
 * @return array
 */
function get_params_from_uri(string $route_uri) : array
{
    $route_params_indexes = get_params_from_route($route_uri);
    $exploded_uri = explode('/', get_uri());
    $params = [];
    foreach ($route_params_indexes as $index) {
        $params[] = $exploded_uri[$index + 1];
    }
    return $params;
}

/**
 * Verify if route uri is compatible with actual uri.
 *
 * @param string $route_uri
 * @return boolean
 */
function is_compatible(string $route_uri) : bool
{
    $route_params_indexes = get_params_from_route($route_uri);
    $exploded_uri = explode('/', get_uri());
    $final = array_slice(explode('/', $route_uri), 1);
    foreach ($route_params_indexes as $index) {
        $final[$index] = $exploded_uri[$index + 1];
    }
    return (('/'. implode('/', $final)) == get_uri());
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