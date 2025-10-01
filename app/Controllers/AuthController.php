<?php
// app/Controllers/AuthController.php
namespace App\Controllers;

class AuthController {
    public function showLogin() {
        require __DIR__ . '/../Views/login.php';
    }

    public function login() {
        session_start();
        if (!empty($_POST['email'])) {
            $_SESSION['email'] = $_POST['email'];
            header('Location: /home');
            exit;
        }
        echo "Veuillez entrer un email valide.";
    }
}
