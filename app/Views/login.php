<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title><?= et('login') ?></title>
</head>
<body>
    <h1><?= et('welcome') ?></h1>
    <form method="POST" action="/login">
        <label><?= et('email') ?> :</label>
        <input type="email" name="email" required>
        <button type="submit"><?= et('login') ?></button>
    </form>

    <!-- Sélecteur de langue -->
    <p>
        <a href="/lang?lang=fr">🇫🇷 <?= et('language_fr') ?></a> | 
        <a href="/lang?lang=en">🇬🇧 <?= et('language_en') ?></a>
    </p>
</body>
</html>
