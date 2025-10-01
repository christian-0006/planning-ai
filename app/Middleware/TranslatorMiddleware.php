<?php
namespace App\Middleware;

use App\Services\Translator;

class TranslatorMiddleware {
    public function handle($request, $next) {
        // On démarre la session si besoin (au cas où SessionMiddleware n'est pas encore passé)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Langue par défaut = fr
        $lang = $_SESSION['lang'] ?? 'fr';

        // On instancie le Translator
        $translator = new Translator($lang);

        // On rend le translator accessible globalement (superglobale PHP)
        $GLOBALS['translator'] = $translator;
        $GLOBALS['lang'] = $lang;

        // On continue la chaîne
        return $next($request);
    }
}
