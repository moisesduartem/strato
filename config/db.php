<?php

namespace config\db;

/**
 * Receives the enviroment credentials.
 */
if (file_exists(__DIR__ . '/.env')) {
    $enviroment = parse_ini_file(__DIR__ . '/.env');
} else {
    throw new \Exception("The '.env' file not exists in 'config' directory. Create it.");
}
/**
 * Define enviroment data one by one.
 */
define('DRIVER', $enviroment['driver']);
define('PORT', $enviroment['port']);
define('HOST', $enviroment['host']);
define('USERNAME', $enviroment['username']);
define('PASSWORD', $enviroment['password']);
define('DATABASE', $enviroment['db_name']);