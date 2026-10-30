<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Note;

class NoteController extends Controller
{
    private const TITLE_MAX = 120;
    private const CONTENT_MAX = 2000;

    public function index(): void
    {
        $this->view('notes/index', [
            'notes'  => Note::all(),
            'editId' => (int)($_GET['edit'] ?? 0),
        ]);
    }

    public function store(): void
    {
        csrf_verify();
        [$title, $content] = $this->input();
        if ($title === '') {
            flash('error', 'Add a title before saving the note.');
        } else {
            Note::create($title, $content);
            flash('success', 'Note added.');
        }
        $this->redirect('/');
    }

    public function update(): void
    {
        csrf_verify();
        [$title, $content] = $this->input();
        if ($title === '') {
            flash('error', 'A note needs a title.');
        } else {
            Note::update((int)($_POST['id'] ?? 0), $title, $content);
            flash('success', 'Note updated.');
        }
        $this->redirect('/');
    }

    public function destroy(): void
    {
        csrf_verify();
        Note::delete((int)($_POST['id'] ?? 0));
        flash('success', 'Note deleted.');
        $this->redirect('/');
    }

    public function notFound(): void
    {
        $this->view('404');
    }

    private function input(): array
    {
        return [
            mb_substr(trim($_POST['title'] ?? ''), 0, self::TITLE_MAX),
            mb_substr(trim($_POST['content'] ?? ''), 0, self::CONTENT_MAX),
        ];
    }
}
