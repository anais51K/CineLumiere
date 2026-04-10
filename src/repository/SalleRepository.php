<?php

namespace repository;

use modele\Salle;

class SalleRepository{
    private $connexionBdd;
    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getSalle($idSalle){
        $sql = "SELECT * FROM CodePromo WHERE idSalle = :idSalle";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idSalle', $idSalle);
        $req->execute();
        $result = $req->fetch();
        $salle = new Salle($result["id-salle"],$result["capacite_max"],$result["code"],$result["etat"]);
        return $salle;
    }

    public function getAllSalle(){
        $sql = "SELECT * FROM Salle";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll();
        $tabSalle = array();
        foreach ($results as $result) {
            $salle = new Salle($result["id_salle"],$result["capacite_max"],$result["code"],$result["etat"]);
            $tabSalle[] = $salle;
        }
        return $tabSalle;
    }

    public function ajouterSalle(Salle $salle){
        $sql= "";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':codePromo', $salle->getCodePromo());
        $req->bindValue(':codePromo', $salle->getCodePromo());
        $req->bindValue(':codePromo', $salle->getCodePromo());
        $req->execute();
    }

    public function supprimerSalle(Salle $salle){
        $sql= "";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idSalle', $salle->getIdSalle());
        $req->execute();
    }

    public function modifierSalle(Salle $salle){
        $sql= "";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idSalle', $salle->getIdSalle());
        $req->execute();
    }

}