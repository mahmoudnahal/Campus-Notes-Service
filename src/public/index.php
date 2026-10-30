<?php
declare(strict_types=1);

require __DIR__ . '/../bootstrap.php';

use App\Controllers\HealthController;
use App\Controllers\NoteController;
use App\Core\Router;

$router = new Router();
$notes  = new NoteController();
$health = new HealthController();

$router->add('GET',  '/',             [$notes, 'index']);
$router->add('POST', '/notes',        [$notes, 'store']);
$router->add('POST', '/notes/update', [$notes, 'update']);
$router->add('POST', '/notes/delete', [$notes, 'destroy']);
$router->add('GET',  '/health',       [$health, 'index']);
$router->notFound([$notes, 'notFound']);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
