<?php
declare(strict_types=1);

/**
 * @author Moisés Mariano
 * @source github.com/moisesduartem
 */

use function config\request\get_method;
use function config\request\get_uri;
use function config\router\execute_route;
use function config\router\get_params_from_uri;
use function config\router\is_compatible;
use function config\router\need_params;

require_once __DIR__ . '/../config/helper.php';
require_once __DIR__ . '/../config/request.php';
require_once __DIR__ . '/../config/router.php';
$routes = require_once __DIR__ . '/../config/routes.php';

/**
 * Start router.
 *
 * @param array $routes
 * @return void
 */
function start(array $routes) : void
{
    $params = [];
    $fake_route = '';
    foreach ($routes as $route) {
        /**
         * Check if the route uri of the turn
         * need params.
         */
        if (need_params($route['uri'])) {
            /**
             * Check if route with params is compatible with
             * actual uri.
             */ 
            if (is_compatible($route['uri'])) {
                $fake_route = get_uri();
                $params = get_params_from_uri($route['uri']);
            }
        }
        /**
         * If request method & uri are compatible...
         */
        if ($route['method'] == get_method() && 
            ($route['uri'] == get_uri() || $fake_route == get_uri())) {
            /**
             * Execute route & pass params.
             */
            execute_route($route, ...$params);
        }
    }
    /**
     * Else...
     * @throws Exception
     */
    throw new Exception("Route doesn't exist.");
}

start($routes);