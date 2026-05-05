<?php
require_once __DIR__ . '/../bdd/Bdd.php';

class SeanceRepository
{
    private $connexionBdd;

    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getSeance($idSeance)
    {
        $sql = "SELECT s.*, f.nom AS film_nom, sa.code AS salle_code, sa.capacite_max
                FROM seance s
                LEFT JOIN film f ON f.id_film = s.ref_film
                LEFT JOIN salle sa ON sa.id_salle = s.ref_salle
                WHERE s.id_seance = :id_seance";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_seance', $idSeance, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllSeance()
    {
        $sql = "SELECT s.*, f.nom AS film_nom, sa.code AS salle_code, sa.capacite_max
                FROM seance s
                LEFT JOIN film f ON f.id_film = s.ref_film
                LEFT JOIN salle sa ON sa.id_salle = s.ref_salle
                ORDER BY s.date DESC";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterSeance($data)
    {
        $sql = "INSERT INTO seance (date, etat, ref_salle, ref_film)
                VALUES (:date, :etat, :ref_salle, :ref_film)";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':date',     $data['date']);
        $req->bindValue(':etat',     $data['etat'] ?? 'programmée');
        $req->bindValue(':ref_salle',$data['ref_salle'], PDO::PARAM_INT);
        $req->bindValue(':ref_film', $data['ref_film'],  PDO::PARAM_INT);
        $req->execute();
        return $this->connexionBdd->lastInsertId();
    }

    public function modifierSeance($id, $data)
    {
        $sql = "UPDATE seance SET date=:date, etat=:etat, ref_salle=:ref_salle, ref_film=:ref_film
                WHERE id_seance=:id_seance";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':date',     $data['date']);
        $req->bindValue(':etat',     $data['etat']);
        $req->bindValue(':ref_salle',$data['ref_salle'], PDO::PARAM_INT);
        $req->bindValue(':ref_film', $data['ref_film'],  PDO::PARAM_INT);
        $req->bindValue(':id_seance',$id,                PDO::PARAM_INT);
        return $req->execute();
    }

    public function supprimerSeance($idSeance)
    {
        $sql = "DELETE FROM seance WHERE id_seance = :id_seance";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_seance', $idSeance, PDO::PARAM_INT);
        return $req->execute();
    }

    public function aDesReservations($idSeance)
    {
        $req = $this->connexionBdd->prepare("SELECT COUNT(*) FROM reservation WHERE ref_seance=:id");
        $req->execute([':id' => $idSeance]);
        return (int)$req->fetchColumn() > 0;
    }

    public function getPlacesRestantes($idSeance, $capacite)
    {
        $req = $this->connexionBdd->prepare(
            "SELECT COALESCE(SUM(nbre_places_adulte+nbre_places_senior+nbre_places_etudiant),0)
             FROM reservation WHERE ref_seance=:id AND etat NOT IN ('annulée','remboursée')"
        );
        $req->execute([':id' => $idSeance]);
        return $capacite - (int)$req->fetchColumn();
    }

    // Alias
    public function getAll()    { return $this->getAllSeance(); }
    public function getById($id){ return $this->getSeance($id); }
    public function ajouter($d) { return $this->ajouterSeance($d); }
    public function modifier($id,$d){ return $this->modifierSeance($id,$d); }
    public function supprimer($id)  { return $this->supprimerSeance($id); }
}
