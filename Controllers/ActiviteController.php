<?php

require_once '../Models/ActiviteModel.php';
require_once '../Entities/Activite.php';

class ActiviteController
{
    private $activiteModel;

    public function __construct()
    {
        $this->activiteModel = new ActiviteModel();
    }

    // Méthode pour récupérer toutes les activités
    public function getAllActivities()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $activities = $this->activiteModel->getAllActivities();
        echo json_encode($activities);
    }

    // Méthode pour récupérer une activité par son ID
    public function getActivityById($id)
    {
        header("Content-Type: application/json; charset=UTF-8");

        if ($id === null) {
            http_response_code(400); // Bad Request
            echo json_encode(['message' => 'ID d\'activité manquant']);
            return;
        }

        $activity = $this->activiteModel->getActivityById($id);
        if ($activity) {
            echo json_encode($activity->toArray()); // Utilisez toArray() pour obtenir un tableau
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['message' => 'Activité non trouvée']);
        }
    }

    // Méthode pour ajouter une nouvelle activité
    public function addActivity()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $data = json_decode(file_get_contents("php://input"));

        // Log des données reçues
        error_log("Données reçues pour addActivity: " . print_r($data, true));

        if (!$data || empty($data->nom_activite) || empty($data->duree)) {
            http_response_code(400); // Bad Request
            echo json_encode(['message' => 'Données manquantes ou invalides']);
            return;
        }

        $activity = new Activite();
        $activity->setNom_activite($data->nom_activite);
        $activity->setDuree($data->duree);
        $activity->setDate_activite(isset($data->date_activite) ? $data->date_activite : date('Y-m-d'));
        $activity->setCommentaire(isset($data->commentaire) ? $data->commentaire : '');
        $activity->setId_categorie(isset($data->id_categorie) ? $data->id_categorie : 1); // Valeur par défaut si non spécifiée

        if ($this->activiteModel->addActivity($activity)) {
            http_response_code(201); // Created
            echo json_encode(['message' => 'Activité ajoutée avec succès']);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['message' => 'Erreur lors de l\'ajout de l\'activité']);
        }
    }

    // Méthode pour modifier une activité
    public function updateActivity($id = null)
    {
        header("Content-Type: application/json; charset=UTF-8");

        if ($id === null) {
            http_response_code(400); // Bad Request
            echo json_encode(['message' => 'ID d\'activité manquant']);
            return;
        }

        // Récupérer les données envoyées
        $data = json_decode(file_get_contents("php://input"));


        if (!$data) {
            http_response_code(400); // Bad Request
            echo json_encode(['message' => 'Données invalides']);
            return;
        }

        $activity = $this->activiteModel->getActivityById($id);

        if (!$activity) {
            http_response_code(404); // Not Found
            echo json_encode(['message' => 'Activité non trouvée']);
            return;
        }

        // Mise à jour uniquement des champs fournis
        if (isset($data->nom_activite)) $activity->setNom_activite($data->nom_activite);
        if (isset($data->duree)) $activity->setDuree($data->duree);
        if (isset($data->date_activite)) $activity->setDate_activite($data->date_activite);
        if (isset($data->commentaire)) $activity->setCommentaire($data->commentaire);
        if (isset($data->id_categorie)) $activity->setId_categorie($data->id_categorie);

        if ($this->activiteModel->updateActivity($activity)) {
            http_response_code(200); // OK
            echo json_encode(['message' => 'Activité mise à jour avec succès']);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['message' => 'Erreur lors de la mise à jour de l\'activité']);
        }
    }

    // Méthode pour supprimer une activité
    public function deleteActivity($id = null)
    {
        header("Content-Type: application/json; charset=UTF-8");

        if ($id === null) {
            http_response_code(400); // Bad Request
            echo json_encode(['message' => 'ID d\'activité manquant']);
            return;
        }

        // Vérifier si l'activité existe avant de la supprimer
        $activity = $this->activiteModel->getActivityById($id);
        if (!$activity) {
            http_response_code(404); // Not Found
            echo json_encode(['message' => 'Activité non trouvée']);
            return;
        }

        if ($this->activiteModel->deleteActivity($id)) {
            http_response_code(200); // OK
            echo json_encode(['message' => 'Activité supprimée avec succès']);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['message' => 'Erreur lors de la suppression de l\'activité']);
        }
    }

    // Méthode pour gérer les erreurs 404
    public function error404()
    {
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code(404);
        echo json_encode(['message' => 'Ressource non trouvée']);
    }

    // GET /activites?activite=musculation
    public function getActivitesByCategory($category)
    {
        $activites = $this->activiteModel->getActivitesByCategory($category); // Filtrer par activité
        echo json_encode($activites);
    }

    // GET /activites/stats
    public function getActivityStats()
    {
        $stats = $this->activiteModel->getActivityStats(); // Calculer les statistiques
        echo json_encode($stats);
    }
}
