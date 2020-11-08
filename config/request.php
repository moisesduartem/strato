<?php
declare(strict_types=1);

namespace config\request;

/**
 * Gives the request HTTP verb.
 *
 * @return string
 */
function get_method() : string
{
   return $_SERVER['REQUEST_METHOD'];
}

/**
 * Gives the actual uri.
 *
 * @return string
 */
function get_uri() : string
{
   return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}

/**
 * Returns request body.
 *
 * @param string $input
 * @return string|array
 */
function request(string $input = '')
{
   parse_str(file_get_contents('php://input'), $content);
   if ($input !== '') {
      return $content[$input];
   }
   return $content;
}