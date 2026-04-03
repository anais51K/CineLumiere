<?php

namespace modele;

class Reservation{
    private $idReservation;
    private $nbPlacesSenior;
    private $nbPlacesEtudiant;
    private $nbPlacesAdulte;
    private $etat;
    private $statut;
    private $modePaiement;

    /**
     * @param $idReservation
     * @param $nbPlacesSenior
     * @param $nbPlacesEtudiant
     * @param $nbPlacesAdulte
     * @param $etat
     * @param $statut
     * @param $modePaiement
     */
    public function __construct($idReservation, $nbPlacesSenior, $nbPlacesEtudiant, $nbPlacesAdulte, $etat, $statut, $modePaiement)
    {
        $this->idReservation = $idReservation;
        $this->nbPlacesSenior = $nbPlacesSenior;
        $this->nbPlacesEtudiant = $nbPlacesEtudiant;
        $this->nbPlacesAdulte = $nbPlacesAdulte;
        $this->etat = $etat;
        $this->statut = $statut;
        $this->modePaiement = $modePaiement;
    }

    /**
     * @return mixed
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @return mixed
     */
    public function getNbPlacesSenior()
    {
        return $this->nbPlacesSenior;
    }

    /**
     * @return mixed
     */
    public function getNbPlacesEtudiant()
    {
        return $this->nbPlacesEtudiant;
    }

    /**
     * @return mixed
     */
    public function getNbPlacesAdulte()
    {
        return $this->nbPlacesAdulte;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @return mixed
     */
    public function getModePaiement()
    {
        return $this->modePaiement;
    }


}