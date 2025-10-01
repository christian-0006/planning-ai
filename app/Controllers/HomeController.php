<?php
namespace App\Controllers;

use App\Services\Translator;

class HomeController {
    public function index() {

        // Vérifie si l'email est bien en session
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

        $email = $_SESSION['email'];

        $translator = new Translator($_SESSION['lang'] ?? 'fr');

        $welcome = $translator->trans('welcome');
        $logout  = $translator->trans('logout');
        
        require __DIR__ . '/../Views/home.php';
    }
}
