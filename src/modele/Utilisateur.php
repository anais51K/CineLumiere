<?php

namespace modele;

class Utilisateur{
    private $idUtilisateur;
    private $nom;
    private $prenom;
    private $dateNaissance;
    private $email;
    private $telephone;
    private $adresse;
    private $motDePasse;
    private $status;
    private $gestion;

    /**
     * @param $idUtilisateur
     * @param $nom
     * @param $prenom
     * @param $dateNaissance
     * @param $email
     * @param $telephone
     * @param $adresse
     * @param $motDePasse
     * @param $status
     * @param $gestion
     */
    public function __construct($idUtilisateur, $nom, $prenom, $dateNaissance, $email, $telephone, $adresse, $motDePasse, $status, $gestion)
    {
        $this->idUtilisateur = $idUtilisateur;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->adresse = $adresse;
        $this->motDePasse = $motDePasse;
        $this->status = $status;
        $this->gestion = $gestion;
    }

    /**
     * @return mixed
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @return mixed
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getGestion()
    {
        return $this->gestion;
    }


}