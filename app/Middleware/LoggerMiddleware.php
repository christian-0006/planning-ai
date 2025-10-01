<?php
namespace App\Middleware;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\ErrorHandler;

class LoggerMiddleware {
    private Logger $logger;

    public function __construct() {
        try {
            // Création d'un logger nommé "app"
            $this->logger = new Logger('app');

            // On récupère le chemin du fichier de log depuis .env
            // Si non défini, on utilise un chemin par défaut
            $logPath = $_ENV['LOG_PATH'] ?? __DIR__ . '/../../storage/logs/app.log';

            // Vérification que le dossier existe, sinon on le crée
            $logDir = dirname($logPath);
            if (!is_dir($logDir)) {
                if (!mkdir($logDir, 0777, true) && !is_dir($logDir)) {
                    throw new \RuntimeException("Impossible de créer le dossier de logs : $logDir");
                }
            }

            // Niveau de log (par défaut DEBUG = 100)
            $logLevel = $_ENV['LOG_LEVEL'] ?? Logger::DEBUG;

            // Ajout d’un handler qui écrit dans le fichier
            $this->logger->pushHandler(new StreamHandler($logPath, $logLevel));

            // On enregistre Monolog comme gestionnaire global des erreurs et exceptions
            ErrorHandler::register($this->logger);

        } catch (\Exception $e) {
            // Si une erreur survient dans la configuration du logger, on affiche un message
            // et on évite que l'application plante
            echo "Erreur lors de l'initialisation du logger : " . htmlspecialchars($e->getMessage());
            // On crée un logger "fallback" qui écrit dans php://stderr
            $this->logger = new Logger('fallback');
            $this->logger->pushHandler(new StreamHandler('php://stderr', Logger::WARNING));
        }
    }

    /**
     * Méthode principale du middleware
     * @param array $request Les données de la requête ($_REQUEST)
     * @param callable $next La fonction suivante dans la chaîne (contrôleur)
     */
    public function handle($request, $next) {
        try {
            // On logue chaque requête entrante
            $this->logger->info("Nouvelle requête reçue", [
                'method' => $_SERVER['REQUEST_METHOD'] ?? 'UNKNOWN',
                'uri'    => $_SERVER['REQUEST_URI'] ?? 'UNKNOWN',
                'params' => $request
            ]);

            // On exécute le contrôleur suivant
            return $next($request);

        } catch (\Throwable $e) {
            // Si une exception survient, on la logue
            $this->logger->error("Erreur dans le middleware ou le contrôleur", [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString()
            ]);

            // On affiche une page d'erreur générique à l'utilisateur
            http_response_code(500);
            echo "<h1>Erreur interne du serveur</h1>";
            echo "<p>Une erreur est survenue. Veuillez réessayer plus tard.</p>";

            // On arrête l'exécution
            exit;
        }
    }
}
