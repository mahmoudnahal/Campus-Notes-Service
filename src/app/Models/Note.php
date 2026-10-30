<?php
declare(strict_types=1);

namespace App\Models;

use App\Config\Database;

class Note
{
    public static function all(): array
    {
        return Database::connect()->query('SELECT * FROM notes ORDER BY id DESC')->fetchAll();
    }

    public static function create(string $title, string $content): void
    {
        Database::connect()
            ->prepare('INSERT INTO notes (title, content) VALUES (?, ?)')
            ->execute([$title, $content]);
    }

    public static function update(int $id, string $title, string $content): void
    {
        Database::connect()
            ->prepare('UPDATE notes SET title = ?, content = ? WHERE id = ?')
            ->execute([$title, $content, $id]);
    }

    public static function delete(int $id): void
    {
        Database::connect()->prepare('DELETE FROM notes WHERE id = ?')->execute([$id]);
    }
}
