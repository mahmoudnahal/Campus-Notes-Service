<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Config\Database;

class HealthController extends Controller
{
    public function index(): void
    {
        header('Content-Type: application/json');
        try {
            Database::connect()->query('SELECT 1');
            $db = 'ok';
        } catch (\Throwable) {
            http_response_code(503);
            $db = 'down';
        }
        echo json_encode([
            'status'   => $db === 'ok' ? 'ok' : 'degraded',
            'database' => $db,
            'time'     => date('c'),
        ]);
    }
}
