<?php

// Debug pour voir les variables serveur
// var_dump($_SERVER['REQUEST_URI']);
// var_dump($_SERVER['SCRIPT_NAME']);
// var_dump($_SERVER['PHP_SELF']);

// Suppression du exit pour exécuter la suite du script
// exit;

// Inclusion du Router
require_once '../Core/Router.php';

$route = str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['REQUEST_URI']);
$route = str_replace(dirname($_SERVER['SCRIPT_NAME']), '', $route);
$route = trim($route, '/');

// var_dump($route); // Devrait afficher "activite"


// var_dump($route); // Ici, ça doit afficher "activite"

// Instancier et exécuter le router
$router = new Router();
// var_dump($route); // Assure-toi qu'il affiche bien "activite"
$router->routes();
