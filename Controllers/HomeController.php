<?php

require_once 'Controller.php';
require_once '../Models/ActiviteModel.php';
require_once '../Entities/Activite.php';


class HomeController extends Controller
{
    // Affiche la vue de l'accueil:
    public function homeAction()
    {
        $this->render('home/homeAction');
    }
}
