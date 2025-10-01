<?php
// app/Controllers/AuthController.php
namespace App\Controllers;

use App\Support\View;
use App\Services\Translator;

class AuthController {
    /**
     * Affiche la page de login, avec le sélecteur de langue.
     */
    public function showLogin() {
        // La session est déjà démarrée par le SessionMiddleware
        // On récupère la langue choisie (défaut: fr)
        $lang = $_SESSION['lang'] ?? 'fr';
        
        // On instancie le Translator avec la langue en session
        $translator = new Translator($lang);

        if (!isset($translator)) {
            // Dernier recours pour éviter le warning, pas recommandé en structure MVC
            $translator = new \App\Services\Translator($_SESSION['lang'] ?? 'fr');
        }
        
        View::render(__DIR__ . '/../Views/login.php', [
            'translator' => $translator,
            'lang' => $lang,
        ]);
    }

    public function login() {
        if (!empty($_POST['email'])) {
            $_SESSION['email'] = $_POST['email'];
            header('Location: /home');
            exit;
        }
        echo "Veuillez entrer un email valide.";
    }

    /**
     * Déconnecte l'utilisateur en détruisant la session
     */
    public function logout() {
        // On s'assure que la session est active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // On vide toutes les variables de session
        $_SESSION = [];

        // On détruit la session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

        // Redirection vers la page de login
        header('Location: /');
        exit;
    }
}
