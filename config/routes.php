<?php
use App\Router;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Middleware\LoggerMiddleware;
use App\Middleware\AuthMiddleware;
use App\Middleware\SessionMiddleware;

$router = new Router();

// On ajoute le middleware globalement
$router->addMiddleware(new SessionMiddleware()); // Toujours en premier
$router->addMiddleware(new LoggerMiddleware());  // Ensuite le logger

// Page de login
$router->get('/', [new AuthController(), 'showLogin']);
$router->post('/login', [new AuthController(), 'login']);

// Routes protégées par AuthMiddleware
$router->get('/home', function($request) {
    // On applique le middleware d'authentification
    $auth = new AuthMiddleware();
    return $auth->handle($request, function($req) {
        return (new HomeController())->index();
    });
});

//logout
$router->get('/logout', function($request) {
    $controller = new AuthController();
    return $controller->logout();
});


return $router;
