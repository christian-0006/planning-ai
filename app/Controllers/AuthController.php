<?php
// app/Controllers/AuthController.php
namespace App\Controllers;

class AuthController {
    public function showLogin() {
        require __DIR__ . '/../Views/login.php';
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
