<?php
class Router
{
    private $controller;
    private $method;
    private $params = [];

    public function routes()
    {
        // Configuration des en-têtes pour l'API (CORS)
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        // Gestion des requêtes OPTIONS (CORS)
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }

        // Récupération des segments de l'URL
        $uriSegments = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

        // Déterminer le contrôleur
        $this->controller = isset($uriSegments[0]) ? ucfirst($uriSegments[0]) . 'Controller' : 'ActiviteController';
        array_shift($uriSegments); // Supprime le premier segment (contrôleur)

        // Déterminer la méthode par défaut
        $this->method = isset($uriSegments[0]) ? $uriSegments[0] : 'getAllActivities';
        array_shift($uriSegments); // Supprime le deuxième segment (méthode)

        // Si c'est une requête POST, PUT ou DELETE, définir la méthode correspondante
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->method = 'addActivity';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $this->method = 'updateActivity';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $this->method = 'deleteActivity';
        }

        // Gestion des cas spécifiques pour GET
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Vérifier si une catégorie est passée en paramètre GET
            if (isset($_GET['activite'])) {
                $this->method = 'getActivitesByCategory';
                $this->params = [$_GET['activite']]; // Transmettre la catégorie comme paramètre
            }
            // Vérifier si l'URL demande les statistiques
            elseif (isset($uriSegments[0]) && $uriSegments[0] === 'stats') {
                $this->method = 'getActivityStats';
            }
        }

        // Inclusion du fichier du contrôleur
        $controllerFile = '../Controllers/' . $this->controller . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Contrôleur non trouvé']);
            exit;
        }

        // Instancier le contrôleur dynamiquement
        $controller = new $this->controller();

        // Vérifier si la méthode existe dans le contrôleur
        if (method_exists($controller, $this->method)) {
            call_user_func_array([$controller, $this->method], $this->params);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Méthode non trouvée']);
            exit;
        }
    }
}
