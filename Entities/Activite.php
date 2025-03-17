<?php
// Class Activite:

class Activite
{

    private $id_activite;
    private $nom_activite;
    private $duree;
    private $date_activite;
    private $commentaire;
    private $id_categorie;


    /**
     * Get the value of id_activite
     */
    public function getId_activite()
    {
        return $this->id_activite;
    }

    /**
     * Set the value of id_activite
     *
     * @return  self
     */
    public function setId_activite($id_activite)
    {
        $this->id_activite = $id_activite;

        return $this;
    }

    /**
     * Get the value of nom_activite
     */
    public function getNom_activite()
    {
        return $this->nom_activite;
    }

    /**
     * Set the value of nom_activite
     *
     * @return  self
     */
    public function setNom_activite($nom_activite)
    {
        $this->nom_activite = $nom_activite;

        return $this;
    }

    /**
     * Get the value of duree
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set the value of duree
     *
     * @return  self
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get the value of date_activite
     */
    public function getDate_activite()
    {
        return $this->date_activite;
    }

    /**
     * Set the value of date_activite
     *
     * @return  self
     */
    public function setDate_activite($date_activite)
    {
        $this->date_activite = $date_activite;

        return $this;
    }

    /**
     * Get the value of commentaire
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set the value of commentaire
     *
     * @return  self
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get the value of id_categorie
     */
    public function getId_categorie()
    {
        return $this->id_categorie;
    }

    /**
     * Set the value of id_categorie
     *
     * @return  self
     */
    public function setId_categorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }
    public function toArray()
    {
        return [
            'id_activite' => $this->id_activite,
            'nom_activite' => $this->nom_activite,
            'duree' => $this->duree,
            'date_activite' => $this->date_activite,
            'commentaire' => $this->commentaire,
            'id_categorie' => $this->id_categorie
        ];
    }
}
