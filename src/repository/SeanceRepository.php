<?php

class SeanceRepository {
    private $connexionBdd;

    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getSeance($idSeance)
    {
        $sql = "SELECT * FROM Seance WHERE id_seance = :idSeance";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idSeance', $idSeance, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetch();

        if (!$result) return null;

        return new Seance(
            $result["id_seance"],
            $result["date"],
            $result["etat"]
        );
    }

    public function getSeancesByFilm($idFilm)
    {
        $sql = "SELECT * FROM Seance WHERE id_film = :idFilm ORDER BY date ASC";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idFilm', $idFilm, PDO::PARAM_INT);
        $req->execute();
        $results = $req->fetchAll();

        $tabSeances = [];

        foreach ($results as $result) {
            $tabSeances[] = new Seance(
                $result["id_seance"],
                $result["date"],
                $result["etat"]
            );
        }

        return $tabSeances;
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
        $sql = "INSERT INTO Seance (date, etat, id_film) VALUES (:date, :etat, :idFilm)";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':date', $seance->getDate());
        $req->bindValue(':etat', $seance->getEtat());
        $req->bindValue(':idFilm', $seance->getIdFilm());
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
