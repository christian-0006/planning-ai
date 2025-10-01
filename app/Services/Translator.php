<?php
namespace App\Services;

class Translator {
    private array $messages = [];
    private string $lang;

    public function __construct(string $lang = 'fr') {
        $this->lang = $lang;

        $file = __DIR__ . '/../../lang/' . $this->lang . '.php';

        if (file_exists($file)) {
            $this->messages = require $file;
        } else {
            // fallback en anglais si fichier manquant
            $this->messages = require __DIR__ . '/../../lang/en.php';
        }
    }

    public function trans(string $key): string {
        return $this->messages[$key] ?? $key;
    }
}
