<?php
use App\Router;
use App\Controllers\AuthController;
use App\Controllers\HomeController;

$router = new Router();

// Page de login
$router->get('/', [new AuthController(), 'showLogin']);
$router->post('/login', [new AuthController(), 'login']);

// Page d’accueil
$router->get('/home', [new HomeController(), 'index']);

return $router;
