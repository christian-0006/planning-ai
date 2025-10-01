<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang ?? 'fr') ?>">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($translator->trans('login')) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($translator->trans('welcome')) ?></h1>
    <form method="POST" action="/login">
        <label><?= htmlspecialchars($translator->trans('email')) ?> :</label>
        <input type="email" name="email" required>
        <button type="submit"><?= htmlspecialchars($translator->trans('login')) ?></button>
    </form>

    <!-- Sélecteur de langue -->
    <p>
        <a href="/lang?lang=fr">🇫🇷 Français</a> | 
        <a href="/lang?lang=en">🇬🇧 English</a>
    </p>
</body>
</html>
