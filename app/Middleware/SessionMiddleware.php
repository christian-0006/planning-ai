<?php
namespace App\Middleware;

class SessionMiddleware {
    /**
     * Ce middleware s’assure qu’une session PHP est démarrée
     * avant de continuer vers les autres middlewares ou contrôleurs.
     */
    public function handle($request, $next) {
        // Vérifie si une session est déjà active
        if (session_status() === PHP_SESSION_NONE) {
            // On tente de démarrer la session
            try {
                session_start();
            } catch (\Throwable $e) {
                // Si une erreur survient, on affiche un message minimal
                // et on arrête l’exécution pour éviter des comportements imprévisibles
                http_response_code(500);
                echo "<h1>Erreur interne</h1>";
                echo "<p>Impossible de démarrer la session.</p>";
                error_log("Erreur session_start : " . $e->getMessage());
                exit;
            }
        }

        // La session est maintenant garantie comme active
        return $next($request);
    }
}
