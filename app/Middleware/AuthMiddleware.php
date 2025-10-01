<?php
namespace App\Middleware;

class AuthMiddleware {
    /**
     * Vérifie si l'utilisateur est authentifié.
     * Si oui → continue vers le contrôleur.
     * Si non → redirige vers la page de login.
     */
    public function handle($request, $next) {
        // On démarre la session si elle n'est pas déjà active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Vérification : l'email est-il stocké en session ?
        if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
            // Pas d'utilisateur connecté → redirection vers la page de login
            header('Location: /');
            exit;
        }

        // Si l'utilisateur est connecté, on continue la chaîne
        return $next($request);
    }
}
