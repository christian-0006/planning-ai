<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Chargement des variables d'environnement
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Chargement des routes
$router = require __DIR__ . '/../config/routes.php';

// Lancement du router
$router->run();
