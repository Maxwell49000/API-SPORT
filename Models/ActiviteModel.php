<?php

require_once '../Core/DbConnect.php';
require_once '../Entities/Activite.php';

class ActiviteModel extends DbConnect
{
    // Récupérer toutes les activités
    public function getAllActivities()
    {
        $sql = 'SELECT * FROM activite';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        // Récupère les résultats sous forme d'objets
        return $stmt->fetchAll(); // Renvoie directement les objets sans transformation
    }



    // Ajouter une nouvelle activité
    public function addActivity(Activite $activity)
    {
        $sql = 'INSERT INTO activite (nom_activite, duree, date_activite, commentaire, Id_categorie) 
                VALUES (:nom_activite, :duree, :date_activite, :commentaire, :id_categorie)';

        $stmt = $this->connection->prepare($sql);

        // Log de la requête et des valeurs
        error_log("SQL: " . $sql);
        error_log("Nom activité: " . $activity->getNom_activite());
        error_log("Durée: " . $activity->getDuree());
        error_log("Date activité: " . $activity->getDate_activite());
        error_log("Commentaire: " . $activity->getCommentaire());
        error_log("ID catégorie: " . $activity->getId_categorie());

        $stmt->bindValue(':nom_activite', $activity->getNom_activite());
        $stmt->bindValue(':duree', $activity->getDuree());
        $stmt->bindValue(':date_activite', $activity->getDate_activite());
        $stmt->bindValue(':commentaire', $activity->getCommentaire());
        $stmt->bindValue(':id_categorie', $activity->getId_categorie());

        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            error_log('Erreur lors de l\'exécution de la requête SQL: ' . print_r($errorInfo, true));
            return false;
        }
    }


    // Modifier une activité existante
    public function updateActivity(Activite $activity)
    {
        $sql = 'UPDATE activite 
                SET nom_activite = :nom_activite, duree = :duree, date_activite = :date_activite, 
                    commentaire = :commentaire, Id_categorie = :id_categorie 
                WHERE id_activite = :id_activite';

        $stmt = $this->connection->prepare($sql);

        // Binding des paramètres
        $stmt->bindValue(':nom_activite', $activity->getNom_activite());
        $stmt->bindValue(':duree', $activity->getDuree());
        $stmt->bindValue(':date_activite', $activity->getDate_activite());
        $stmt->bindValue(':commentaire', $activity->getCommentaire());
        $stmt->bindValue(':id_categorie', $activity->getId_categorie());
        $stmt->bindValue(':id_activite', $activity->getId_activite());

        // Exécution de la requête
        return $stmt->execute();
    }

    // Supprimer une activité
    public function deleteActivity($id_activite)
    {
        $sql = 'DELETE FROM activite WHERE id_activite = :id_activite';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id_activite', $id_activite);
        return $stmt->execute();
    }

    // Récupérer une activité par son ID
    public function getActivityById($id_activite)
    {
        $sql = 'SELECT * FROM activite WHERE id_activite = :id_activite';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id_activite', $id_activite);
        $stmt->execute();

        // Récupérer la ligne sous forme d'objet
        $row = $stmt->fetch(PDO::FETCH_OBJ);  // Utiliser PDO::FETCH_OBJ pour obtenir un objet

        if ($row) {
            $activity = new Activite();
            $activity->setId_activite($row->id_activite);
            $activity->setNom_activite($row->nom_activite);
            $activity->setDuree($row->duree);
            $activity->setDate_activite($row->date_activite);
            $activity->setCommentaire($row->commentaire);
            $activity->setId_categorie($row->id_categorie);
            return $activity;
        }
        return null; // Si aucune activité n'est trouvée
    }


    // Model Method
    public function getActivitesByCategory($categorie)
    {
        $sql = 'SELECT a.* FROM activite a 
            JOIN categorie c ON a.id_categorie = c.id_categorie 
            WHERE c.nom_categorie = :categorie';  // On filtre par le nom de la catégorie

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':categorie', $categorie, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    // Model Method
    public function getActivityStats()
    {
        $sql = 'SELECT c.nom_categorie, COUNT(a.id_activite) AS nombre_seances, SUM(a.duree) AS total_minutes 
            FROM activite a 
            JOIN categorie c ON a.id_categorie = c.id_categorie 
            GROUP BY c.nom_categorie';  // Regrouper par catégorie

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
