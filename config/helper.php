<?php
declare(strict_types=1);

/**
 * @author Moisés Mariano
 * @source github.com/moisesduartem
 */

namespace config\helper;
use \PDO;
use \PDOStatement;

/**
 * Render a twig view.
 *
 * @param string $view
 * @param array $data
 * @return void
 */
function view(string $view, array $data = []) : void
{
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../app/views');
    $twig = new \Twig\Environment($loader, [
        // 'cache' => __DIR__ . '/../cache',
    ]);
    $view = str_replace('.', '/', $view);
    echo $twig->render($view . '.twig', $data);
}

/**
 * Helpers to execute SQL queries with
 * the credentials passed on config.env.
 *
 * @param string $sql
 * @param array $params
 * @return PDOStatement
 */
function pdo(string $sql, array $params = []) : PDOStatement
{
    /**
     * Receives a PDO instance.
     */
    $pdo = new PDO(
        DRIVER . ':' . 'host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8',
        USERNAME,
        PASSWORD  
    );
    /**
     * Prepare the query.
     */
    $stmt = $pdo->prepare($sql);
    /**
     * Check params
     */
    if ($params !== []) {
        /**
         * If passed params, bind them.
         */
        foreach ($params as $key => $value) {
            $stmt->bindParam($key, $value);
        }
    }
    /**
     * Execute the statement.
     */
    $stmt->execute();
    return $stmt;
}