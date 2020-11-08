<?php
declare(strict_types=1);

namespace app\middlewares\auth;

/**
 * Authorization middleware example.
 *
 * @return void
 */
function auth()
{
    $is_not_authorized = true;
    if ($is_not_authorized) {
        header('Location: /hello/stranger');
    }
}