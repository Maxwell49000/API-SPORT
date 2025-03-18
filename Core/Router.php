<?php
class Router
{
    private $controller;
    private $method;
    private $params = [];

    public function routes()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }

        // error_log('DEBUG - URI : ' . $_SERVER['REQUEST_URI']);

        // Récupère le chemin de base
        $basePath = dirname($_SERVER['SCRIPT_NAME']);

        // Récupère l'URI demandée
        $uri = $_SERVER['REQUEST_URI'];

        // Supprime le chemin de base s'il est présent
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        // Nettoyage final de l'URI
        $uri = trim($uri, '/');

        // Découpe l'URI en segments
        $uriSegments = explode('/', $uri);

        // ✅ Déterminer le contrôleur
        $this->controller = !empty($uriSegments[0]) ? ucfirst($uriSegments[0]) . 'Controller' : 'ActiviteController';
        array_shift($uriSegments);

        // ✅ Déterminer la méthode
        $this->method = !empty($uriSegments[0]) ? $uriSegments[0] : 'getAllActivities';
        array_shift($uriSegments);

        // ✅ Inclusion du fichier contrôleur
        $controllerFile = __DIR__ . '/../Controllers/' . $this->controller . '.php';

        if (!file_exists($controllerFile)) {
            http_response_code(404);
            echo json_encode(['message' => 'Contrôleur non trouvé: ' . $this->controller]);
            exit;
        }
        require_once $controllerFile;

        // ✅ Vérification de l'existence de la classe
        if (!class_exists($this->controller)) {
            http_response_code(500);
            echo json_encode(['message' => 'Classe introuvable dans le contrôleur']);
            exit;
        }

        // Instanciation du contrôleur
        $controller = new $this->controller();

        // ✅ Vérification de la méthode
        if (!method_exists($controller, $this->method)) {
            http_response_code(404);
            echo json_encode(['message' => 'Méthode non trouvée: ' . $this->method]);
            exit;
        }

        // ✅ Exécuter la méthode demandée
        call_user_func_array([$controller, $this->method], $this->params);
    }
}
