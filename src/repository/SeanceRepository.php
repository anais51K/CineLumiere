<?php

namespace repository;

class SeanceRepository{
    private $connexionBdd;
    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getSeance($idSeance)
    {
        $sql = "SELECT * FROM Seance WHERE id_seance = :idSeance";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idSeance', $idSeance, \PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetch();
        if (!$result) return null;

        return new Seance(
            $result["id_seance"],
            $result["date"],
            $result["etat"]
        );
    }

    public function getAllSeance()
    {
        $sql = "SELECT * FROM Seance ORDER BY date DESC";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll();
        $tabSeance = [];

        foreach ($results as $result) {
            $tabSeance[] = new Seance(
                $result["id_seance"],
                $result["date"],
                $result["etat"]
            );
        }

        return $tabSeance;
    }

    public function ajouterSeance(Seance $seance)
    {
        $sql = "INSERT INTO Seance (date, etat) VALUES (:date, :etat)";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':date', $seance->getDate());
        $req->bindValue(':etat', $seance->getEtat());
        return $req->execute();
    }

    public function modifierSeance(Seance $seance)
    {
        $sql = "UPDATE Seance SET date = :date, etat = :etat WHERE id_seance = :idSeance";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':date', $seance->getDate());
        $req->bindValue(':etat', $seance->getEtat());
        $req->bindValue(':idSeance', $seance->getIdSeance());
        return $req->execute();
    }

    public function supprimerSeance($idSeance)
    {
        $sql = "DELETE FROM Seance WHERE id_seance = :idSeance";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idSeance', $idSeance);
        return $req->execute();
    }

}