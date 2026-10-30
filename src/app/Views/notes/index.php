<form method="post" action="/notes" class="composer">
    <?= csrf_field() ?>
    <input name="title" placeholder="Note title" maxlength="120" required aria-label="Note title">
    <textarea name="content" placeholder="Write the details here..." rows="3" maxlength="2000" aria-label="Note content"></textarea>
    <div class="composer-foot">
        <span class="count"><?= count($notes) ?> <?= count($notes) === 1 ? 'note' : 'notes' ?> saved</span>
        <button type="submit" class="btn primary">Save note</button>
    </div>
</form>

<?php if (!$notes): ?>
    <section class="empty">
        <h2>Nothing here yet</h2>
        <p>Write your first note above, a lecture summary or a deadline is a good start.</p>
    </section>
<?php endif; ?>

<?php foreach ($notes as $n): ?>
    <article class="note">
        <?php /** @var array $notes */ /** @var int $editId */ ?>
        <?php if ($editId === (int)$n['id']): ?>
            <form method="post" action="/notes/update">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= (int)$n['id'] ?>">
                <input name="title" value="<?= e($n['title']) ?>" maxlength="120" required aria-label="Note title">
                <textarea name="content" rows="4" maxlength="2000" aria-label="Note content"><?= e($n['content']) ?></textarea>
                <div class="actions">
                    <button type="submit" class="btn primary">Save changes</button>
                    <a href="/" class="btn ghost">Cancel</a>
                </div>
            </form>
        <?php else: ?>
            <h2><?= e($n['title']) ?></h2>
            <?php if ($n['content'] !== ''): ?>
                <p><?= nl2br(e($n['content'])) ?></p>
            <?php endif; ?>
            <div class="note-foot">
                <time datetime="<?= e($n['created_at']) ?>"><?= e(date('M j, Y', strtotime($n['created_at']))) ?></time>
                <div class="actions">
                    <a href="/?edit=<?= (int)$n['id'] ?>" class="btn ghost">Edit</a>
                    <form method="post" action="/notes/delete" onsubmit="return confirm('Delete this note?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= (int)$n['id'] ?>">
                        <button type="submit" class="btn danger">Delete</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </article>
<?php endforeach; ?>
