<?php
namespace App\Controllers;

class HomeController {
    public function index() {

        // Vérifie si l'email est bien en session
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

        $email = $_SESSION['email'];

        require __DIR__ . '/../Views/home.php';
    }
}
