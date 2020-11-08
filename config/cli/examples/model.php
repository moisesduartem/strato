<?php
declare(strict_types=1);

namespace app\models\$entity;
use function config\helper\pdo;

function all_$entitys()
{
    return pdo('select * from $entitys')->fetchAll(\PDO::FETCH_ASSOC);
}

function find_$entity($id)
{
    return pdo('select * from $entitys where id = :id', ['id' => $id])->fetch(\PDO::FETCH_ASSOC);
}

function update_$entity($id, $request)
{
    pdo('update $entitys set $set_columns where id = :id', ['id' => $id, $bind_columns]);
    return find_$entity($id);
}

function delete_$entity($id)
{
    pdo('delete from where id = :id', ['id' => $id]);
    return [];
}