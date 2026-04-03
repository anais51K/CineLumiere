<?php

namespace repository;

use modele\Film;

class FilmRepository{
    private $connexionBdd;
    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }
    public function getFilm($idFilm){
        $sql = "SELECT * FROM Film WHERE idfilm = :idfilm";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idFilm', $idFilm);
        $req->execute();
        $result = $req->fetch();
        $film = new Film($result["id_film"],$result["nom"],$result["duree"],$result["affiche"]);$result["genre"],$result["age_min"],$result["realisateur"],$result["date_sortie"],$result["bande_annonce"];
        return $film;
    }
    public function getAllFilm(){
        $sql = "SELECT * FROM Film";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll();
        $tabFilm = array();
        foreach ($results as $result) {
            $film = new Film($result["id_film"],$result["nom"],$result["duree"],$result["affiche"],$result["genre"],$result["age_min"],$result["realisateur"],$result["date_sortie"],$result["bande_annonce"]);
            $tabFilm[] = $film;
        }
        return $tabCodePromo;
    }
    public function ajouterFilm(Film $film){
        $sql= "";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':nom', $film->getNom());
        $req->bindValue(':duree', $film->getDuree());
        $req->binValue(':affiche', $film->getAffiche());
        $req->bindValue(':genre', $film->getGenre());
        $req->bindValue(':age_min', $film->getAgeMin());
        $req->bindValue(':realisateur', $film->getRealisateur());
        $req->bindValue(':date_sortie', $film->getDateSortie());
        $req->bindValue(':bande_annonce', $film->getBandeAnnonce());
        $req->execute();
}