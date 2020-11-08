<?php
declare(strict_types=1);

namespace app\controllers\user_controller;
require __DIR__ . '/../models/user.php';
use function app\models\user\get_user;

function index()
{
}

function hello($name)
{
    return ['name' => $name];
}

function show($id)
{
    return ['user' => get_user((int) $id)];
}