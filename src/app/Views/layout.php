<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campus Notes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<header class="masthead">
    <h1>Campus <span>Notes</span></h1>
    <p>Lecture ideas, deadlines and reading lists, kept in one quiet place.</p>
</header>
<main>
    <?php if ($flash): ?>
        <div class="flash <?= e($flash['type']) ?>" role="status"><?= e($flash['message']) ?></div>
    <?php endif; ?>
    <?= $content ?>
</main>
<footer>Campus Notes Service &middot; PHP &amp; SQLite</footer>
</body>
</html>
