<?php
declare(strict_types=1);

namespace app\models\book;
use function config\helper\pdo;

function all_books()
{
    return pdo('select * from books')->fetchAll(\PDO::FETCH_ASSOC);
}

function find_book($id)
{
    return pdo('select * from books where id = :id', ['id' => $id])->fetch(\PDO::FETCH_ASSOC);
}

function create_book($request)
{
    pdo('insert into books (id, title, author) values (:id, :title, :author)', ['id' => $request['id'],'title' => $request['title'],'author' => $request['author']]);
    return [];
}

function update_book($id, $request)
{
    pdo('update books set id = :id, title = :title, author = :author where id = :id', ['id' => $id, 'id' => $request['id'],'title' => $request['title'],'author' => $request['author']]);
    return find_book($id);
}

function delete_book($id)
{
    pdo('delete from where id = :id', ['id' => $id]);
    return [];
}