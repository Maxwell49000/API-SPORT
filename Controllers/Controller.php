<?php
// Déclaration d'une classe abstraite appelée "Controller"
abstract class Controller
{

    // Méthode publique appelée "render"
    // Cette méthode est utilisée pour afficher une vue, en passant éventuellement des données dynamiques.
    public function render($view, $data = [])
    {
        // La fonction PHP "extract" convertit les clés d'un tableau associatif en variables.
        // Cela permet d'accéder aux données du tableau $data sous forme de variables dans la vue.
        extract($data);

        // Inclusion du fichier "header.php" depuis le répertoire "../views".
        // Ce fichier est généralement utilisé pour inclure l'en-tête HTML commun à toutes les pages.
        require_once '../views/header.php';


        // Inclusion du fichier de vue spécifique.
        // La variable $view représente le nom du fichier de vue (sans l'extension .php).
        // La syntaxe 'require_once' garantit que le fichier n'est inclus qu'une seule fois.
        require_once '../views/' . $view . '.php';


         // Inclusion du fichier "footer.php" depuis le répertoire "../views".
        // Ce fichier est généralement utilisé pour inclure le pied de page HTML commun à toutes les pages.
        require_once '../views/footer.php';
    }
}
