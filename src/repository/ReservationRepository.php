<?php
require_once __DIR__ . '/../bdd/Bdd.php';

class ReservationRepository
{
    private $connexionBdd;

    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getReservation($idReservation)
    {
        $sql = "SELECT r.*, f.nom AS film_nom, s.date AS seance_date, sa.code AS salle_code
                FROM reservation r
                LEFT JOIN seance s ON s.id_seance = r.ref_seance
                LEFT JOIN film f ON f.id_film = s.ref_film
                LEFT JOIN salle sa ON sa.id_salle = s.ref_salle
                WHERE r.id_reservation = :id_reservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_reservation', $idReservation, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllReservations()
    {
        $sql = "SELECT r.*, f.nom AS film_nom, s.date AS seance_date, sa.code AS salle_code
                FROM reservation r
                LEFT JOIN seance s ON s.id_seance = r.ref_seance
                LEFT JOIN film f ON f.id_film = s.ref_film
                LEFT JOIN salle sa ON sa.id_salle = s.ref_salle
                ORDER BY r.id_reservation DESC";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterReservation($data)
    {
        $sql = "INSERT INTO reservation (nbre_places_senior, nbre_places_etudiant, nbre_places_adulte,
                etat, mode_paiement, ref_utilisateur, ref_seance, ref_code_promo)
                VALUES (:senior, :etudiant, :adulte, :etat, :paiement, :utilisateur, :seance, :promo)";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':senior',    $data['nbre_places_senior']    ?? 0, PDO::PARAM_INT);
        $req->bindValue(':etudiant',  $data['nbre_places_etudiant']  ?? 0, PDO::PARAM_INT);
        $req->bindValue(':adulte',    $data['nbre_places_adulte']    ?? 0, PDO::PARAM_INT);
        $req->bindValue(':etat',      $data['etat']                  ?? 'en attente');
        $req->bindValue(':paiement',  $data['mode_paiement']         ?? 'en ligne');
        $req->bindValue(':utilisateur',$data['ref_utilisateur']      ?? 1, PDO::PARAM_INT);
        $req->bindValue(':seance',    $data['ref_seance'],              PDO::PARAM_INT);
        $req->bindValue(':promo',     $data['ref_code_promo']        ?? null);
        $req->execute();
        return $this->connexionBdd->lastInsertId();
    }

    public function modifierReservation($id, $data)
    {
        $sql = "UPDATE reservation SET nbre_places_senior=:senior, nbre_places_etudiant=:etudiant,
                nbre_places_adulte=:adulte, etat=:etat, mode_paiement=:paiement,
                ref_seance=:seance, ref_code_promo=:promo WHERE id_reservation=:id";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':senior',  $data['nbre_places_senior']   ?? 0, PDO::PARAM_INT);
        $req->bindValue(':etudiant',$data['nbre_places_etudiant'] ?? 0, PDO::PARAM_INT);
        $req->bindValue(':adulte',  $data['nbre_places_adulte']   ?? 0, PDO::PARAM_INT);
        $req->bindValue(':etat',    $data['etat']);
        $req->bindValue(':paiement',$data['mode_paiement']);
        $req->bindValue(':seance',  $data['ref_seance'],             PDO::PARAM_INT);
        $req->bindValue(':promo',   $data['ref_code_promo']        ?? null);
        $req->bindValue(':id',      $id,                             PDO::PARAM_INT);
        return $req->execute();
    }

    public function supprimerReservation($idReservation)
    {
        $sql = "DELETE FROM reservation WHERE id_reservation = :id_reservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_reservation', $idReservation, PDO::PARAM_INT);
        return $req->execute();
    }

    // Alias
    public function getAll()    { return $this->getAllReservations(); }
    public function getById($id){ return $this->getReservation($id); }
    public function ajouter($d) { return $this->ajouterReservation($d); }
    public function modifier($id,$d){ return $this->modifierReservation($id,$d); }
    public function supprimer($id)  { return $this->supprimerReservation($id); }
}
