<?php
declare(strict_types=1);

namespace app\models\user;
use function config\helper\pdo;

/**
 * Returns a user by id
 *
 * @param int $id
 * @return void
 */
function get_user(int $id)
{
    return pdo('select * from users where id = :id', ['id' => $id])->fetch(\PDO::FETCH_ASSOC);
}