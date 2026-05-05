<?php

namespace repository;

use modele\Reservation;

class ReservationRepository
{
    private $connexionBdd;

    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getReservation($idReservation)
    {
        $sql = "SELECT * FROM Reservation WHERE id_reservation = :idReservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idReservation', $idReservation);
        $req->execute();
        $result = $req->fetch();
        $reservation = new Reservation(
            $result["id_reservation"],
            $result["nbre_places_senior"],
            $result["nbre_places_etudiant"],
            $result["nbre_places_adulte"],
            $result["etat"],
            $result["statut"],
            $result["mode_paiement"]
        );
        return $reservation;
    }

    public function getAllReservations()
    {
        $sql = "SELECT * FROM Reservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll();
        $tabReservations = array();
        foreach ($results as $result) {
            $reservation = new Reservation(
                $result["id_reservation"],
                $result["nbre_places_senior"],
                $result["nbre_places_etudiant"],
                $result["nbre_places_adulte"],
                $result["etat"],
                $result["statut"],
                $result["mode_paiement"]
            );
            $tabReservations[] = $reservation;
        }
        return $tabReservations;
    }

    public function ajouterReservation(Reservation $reservation)
    {
        $sql = "INSERT INTO Reservation (nbre_places_senior, nbre_places_etudiant, nbre_places_adulte, etat, statut, mode_paiement)
                VALUES (:nbrePlacesSenior, :nbrePlacesEtudiant, :nbrePlacesAdulte, :etat, :statut, :modePaiement)";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':nbrePlacesSenior', $reservation->getNbPlacesSenior());
        $req->bindValue(':nbrePlacesEtudiant', $reservation->getNbPlacesEtudiant());
        $req->bindValue(':nbrePlacesAdulte', $reservation->getNbPlacesAdulte());
        $req->bindValue(':etat', $reservation->getEtat());
        $req->bindValue(':statut', $reservation->getStatut());
        $req->bindValue(':modePaiement', $reservation->getModePaiement());
        $req->execute();
    }

    public function modifierReservation(Reservation $reservation)
    {
        $sql = "UPDATE Reservation
                SET nbre_places_senior = :nbrePlacesSenior,
                    nbre_places_etudiant = :nbrePlacesEtudiant,
                    nbre_places_adulte = :nbrePlacesAdulte,
                    etat = :etat,
                    statut = :statut,
                    mode_paiement = :modePaiement
                WHERE id_reservation = :idReservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':nbrePlacesSenior', $reservation->getNbPlacesSenior());
        $req->bindValue(':nbrePlacesEtudiant', $reservation->getNbPlacesEtudiant());
        $req->bindValue(':nbrePlacesAdulte', $reservation->getNbPlacesAdulte());
        $req->bindValue(':etat', $reservation->getEtat());
        $req->bindValue(':statut', $reservation->getStatut());
        $req->bindValue(':modePaiement', $reservation->getModePaiement());
        $req->bindValue(':idReservation', $reservation->getIdReservation());
        $req->execute();
    }

    public function supprimerReservation($idReservation)
    {
        $sql = "DELETE FROM Reservation WHERE id_reservation = :idReservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idReservation', $idReservation);
        $req->execute();
    }
}