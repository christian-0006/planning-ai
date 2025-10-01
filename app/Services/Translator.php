<?php
namespace App\Services;

class Translator {
    private array $messages = [];
    private array $fallbackMessages = [];
    private string $lang;
    private string $fallbackLang = 'en'; // langue de secours

    public function __construct(string $lang = 'fr') {
        $this->lang = $lang;

        // Charger la langue principale
        $file = __DIR__ . '/../../lang/' . $this->lang . '.php';
        if (file_exists($file)) {
            $this->messages = require $file;
        }

        // Charger la langue fallback (toujours anglais ici)
        $fallbackFile = __DIR__ . '/../../lang/' . $this->fallbackLang . '.php';
        if (file_exists($fallbackFile)) {
            $this->fallbackMessages = require $fallbackFile;
        }
    }

    public function trans(string $key): string {
        // 1. Chercher dans la langue active
        if (isset($this->messages[$key])) {
            return $this->messages[$key];
        }

        // 2. Sinon, chercher dans la langue fallback
        if (isset($this->fallbackMessages[$key])) {
            return $this->fallbackMessages[$key];
        }

        // 3. Sinon, retourner la clé brute (debug)
        return $key;
    }
}
