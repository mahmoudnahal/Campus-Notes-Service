<?php
declare(strict_types=1);

namespace App\Core;

class Router
{
    private array $routes = [];
    private $notFound;

    public function add(string $method, string $path, callable $handler): void
    {
        $this->routes[$method][$path] = $handler;
    }

    public function notFound(callable $handler): void
    {
        $this->notFound = $handler;
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = rtrim((string)parse_url($uri, PHP_URL_PATH), '/') ?: '/';
        $handler = $this->routes[$method][$path] ?? null;
        if ($handler === null) {
            http_response_code(404);
            $handler = $this->notFound;
        }
        $handler();
    }
}
