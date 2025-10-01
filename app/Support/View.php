<?php
namespace App\Support;

/**
 * Rend une vue en lui injectant explicitement des données.
 */
class View {
    public static function render(string $path, array $data = []): void {
        // Injecte les clés du tableau comme variables locales de la vue
        extract($data, EXTR_SKIP);
        require $path;
    }
}
