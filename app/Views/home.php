<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>
    <h1>Bonjour 👋</h1>
    <p>J’ai bien reçu votre email : <strong><?= htmlspecialchars($email) ?></strong></p>
    <!-- Bouton de déconnexion -->
    <form action="/logout" method="get">
        <button type="submit">Se déconnecter</button>
    </form>
</body>
</html>
