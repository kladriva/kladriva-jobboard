<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace d'administration</title>
    <?php foreach($css_files as $file): ?>
        <link rel="stylesheet" href="<?= $file; ?>">
    <?php endforeach; ?>
</head>
<body>
    <h1>Administration</h1>
    <?= $output; ?>
    <?php foreach($js_files as $file): ?>
        <script src="<?= $file; ?>"></script>
    <?php endforeach; ?>
</body>
</html>
