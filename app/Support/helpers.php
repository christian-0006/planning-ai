<?php
use App\Services\Translator;

if (!function_exists('t')) {
    function t(string $key): string {
        if (isset($GLOBALS['translator']) && $GLOBALS['translator'] instanceof Translator) {
            return $GLOBALS['translator']->trans($key);
        }
        $translator = new Translator($_SESSION['lang'] ?? 'fr');
        return $translator->trans($key);
    }
}

if (!function_exists('e')) {
    function e(string $value): string {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('et')) {
    /**
     * Traduction + échappement HTML
     * Exemple : <?= et('welcome') ?>
     */
    function et(string $key): string {
        return htmlspecialchars(t($key), ENT_QUOTES, 'UTF-8');
    }
}
