<?php
declare(strict_types=1);

/**
 * @author Moisés Mariano
 * @source github.com/moisesduartem
 */

namespace config\helper;

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