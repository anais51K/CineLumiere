<?php
require_once __DIR__ . '/../bdd/Bdd.php';

class SalleRepository
{
    private $connexionBdd;

    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getSalle($idSalle)
    {
        $sql = "SELECT * FROM salle WHERE id_salle = :id_salle";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_salle', $idSalle, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllSalle()
    {
        $sql = "SELECT * FROM salle ORDER BY code ASC";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterSalle($data)
    {
        $sql = "INSERT INTO salle (code, capacite_max, etat) VALUES (:code, :capacite_max, :etat)";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':code',        strtoupper($data['code']));
        $req->bindValue(':capacite_max',$data['capacite_max'], PDO::PARAM_INT);
        $req->bindValue(':etat',        $data['etat'] ?? 'disponible');
        $req->execute();
        return $this->connexionBdd->lastInsertId();
    }

    public function modifierSalle($id, $data)
    {
        $sql = "UPDATE salle SET code=:code, capacite_max=:capacite_max, etat=:etat WHERE id_salle=:id_salle";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':code',        strtoupper($data['code']));
        $req->bindValue(':capacite_max',$data['capacite_max'], PDO::PARAM_INT);
        $req->bindValue(':etat',        $data['etat']);
        $req->bindValue(':id_salle',    $id, PDO::PARAM_INT);
        return $req->execute();
    }

    public function supprimerSalle($idSalle)
    {
        // Désactivation (pas suppression physique)
        $sql = "UPDATE salle SET etat='fermée' WHERE id_salle = :id_salle";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_salle', $idSalle, PDO::PARAM_INT);
        return $req->execute();
    }

    public function estOccupee($idSalle, $date, $exclure = null)
    {
        $sql = "SELECT COUNT(*) FROM seance WHERE ref_salle=:s AND DATE(date)=DATE(:d) AND etat!='annulée'";
        if ($exclure) $sql .= " AND id_seance!=:e";
        $req = $this->connexionBdd->prepare($sql);
        $p = [':s' => $idSalle, ':d' => $date];
        if ($exclure) $p[':e'] = $exclure;
        $req->execute($p);
        return (int)$req->fetchColumn() > 0;
    }

    // Alias
    public function getAll()    { return $this->getAllSalle(); }
    public function getById($id){ return $this->getSalle($id); }
    public function ajouter($d) { return $this->ajouterSalle($d); }
    public function modifier($id,$d){ return $this->modifierSalle($id,$d); }
    public function desactiver($id){ return $this->supprimerSalle($id); }
}
