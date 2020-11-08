<?php
declare(strict_types=1);

namespace config\request;

function get_method() : string
{
   return $_SERVER['REQUEST_METHOD'];
}

function get_uri() : string
{
   return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}