# Planning AI

Un petit projet de planning en **PHP 8** avec architecture **MVC**, gestion des sessions, internationalisation (FR/EN) et logs avec **Monolog**.

## 🚀 Installation

1. Cloner le dépôt :
   git clone https://github.com/tonpseudo/planning-ai.git
   cd planning-ai

2. Installer les dépendances :
    composer install
    
3. Créer un fichier .env à la racine :
    .env
    APP_NAME="Planning AI"
    APP_ENV=dev
    APP_DEBUG=true
    APP_LANG=fr

4. Lancer le serveur PHP :
    php -S localhost:8000 -t public

## Information
1. Structure du projet
    app/
    ├── Controllers/   # Logique métier
    ├── Middleware/    # Middlewares (ex: Monolog)
    ├── Views/         # Templates HTML
    └── Router.php     # Router maison
    config/             # Routes et config
    public/             # Point d'entrée (index.php)
    storage/logs/       # Logs générés par Monolog

2. Fonctionnalités
    Formulaire de connexion par email
    Session utilisateur
    Page d’accueil personnalisée
    Router MVC minimaliste
    Multi-langues (FR/EN)
    Logs avec Monolog

3. 🛠 À venir
    Gestion des utilisateurs
    Base de données
    Interface de planning