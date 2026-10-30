<?php
declare(strict_types=1);

namespace App\Controllers;

abstract class Controller
{
    protected function view(string $name, array $data = []): void
    {
        extract($data);
        ob_start();
        require dirname(__DIR__) . "/Views/$name.php";
        $content = ob_get_clean();
        $flash = flash_pull();
        require dirname(__DIR__) . '/Views/layout.php';
    }

    protected function redirect(string $to): never
    {
        header("Location: $to");
        exit;
    }
}
