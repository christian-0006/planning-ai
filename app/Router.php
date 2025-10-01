<?php
// app/Router.php
namespace App;

class Router {
    private array $routes = [];
    private array $middlewares = [];  // Tableau des middlewares enregistrés

    // Enregistre une route GET
    public function get(string $path, callable $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    // Enregistre une route POST
    public function post(string $path, callable $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    // Ajoute un middleware à la pile
    public function addMiddleware($middleware) {
        $this->middlewares[] = $middleware;
    }

    // Exécute la route correspondante
    public function run() {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Vérifie si la route existe
        $callback = $this->routes[$method][$uri] ?? null;

        if (!$callback) {
            http_response_code(404);
            echo "404 - Page non trouvée";
            return;
        }

        // On prépare la requête (ici $_REQUEST, mais tu pourrais créer un objet Request plus tard)
        $request = $_REQUEST;

        // Fonction finale qui appelle le contrôleur
        $next = function($req) use ($callback) {
            return call_user_func($callback, $req);
        };

        // On enchaîne les middlewares dans l’ordre
        foreach (array_reverse($this->middlewares) as $middleware) {
            $next = function($req) use ($middleware, $next) {
                return $middleware->handle($req, $next);
            };
        }

        // On lance la chaîne de middlewares → contrôleur
        $next($request);
    }
}
