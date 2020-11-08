<?php
declare(strict_types=1);

namespace app\controllers\user_controller;

function index()
{
    echo '~ hello world!';
}

function hello($name)
{
    echo 'hello ' . $name;
}

function book($user_id, $book_id)
{
    echo 'user_id: ' . $user_id .  '<br>' . 'book_id: ' . $book_id;
}