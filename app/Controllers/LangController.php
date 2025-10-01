<?php
namespace App\Controllers;

class LangController {
    public function switch($request) {
        // On démarre la session si besoin
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifie si une langue est passée en paramètre
        $lang = $request['lang'] ?? 'fr';

        // On accepte uniquement fr ou en
        if (!in_array($lang, ['fr', 'en'])) {
            $lang = 'fr';
        }

        // On stocke le choix en session
        $_SESSION['lang'] = $lang;

        // Redirection vers la page précédente ou vers /
        $redirect = $_SERVER['HTTP_REFERER'] ?? '/';
        header("Location: $redirect");
        exit;
    }
}
