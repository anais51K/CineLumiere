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


}