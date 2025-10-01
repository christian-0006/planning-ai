<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title><?= et('welcome') ?></title>
</head>
<body>
    <h1><?= et('welcome') ?> 👋</h1>
    <p>J’ai bien reçu votre email : <strong><?= et('email') ?></strong></p>
    <!-- Bouton de déconnexion -->
    <form action="/logout" method="get">
        <button type="submit"><?= et('logout') ?></button>
    </form>
</body>
</html>
