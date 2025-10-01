<?php
// app/Controllers/HomeController.php
namespace App\Controllers;

class HomeController {
    public function index() {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }
        $email = $_SESSION['email'];
        require __DIR__ . '/../Views/home.php';
    }
}
