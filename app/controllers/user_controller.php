<?php
declare(strict_types=1);

namespace app\controllers\user_controller;
use function config\helper\view;

function index()
{
    return view('users.index');
}

function hello($name)
{
    echo 'hello ' . $name;
}

function book($user_id, $book_id)
{
    echo 'user_id: ' . $user_id .  '<br>' . 'book_id: ' . $book_id;
}