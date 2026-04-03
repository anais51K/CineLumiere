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


}