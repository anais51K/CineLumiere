<?php

class Bdd{
    private $connexionBdd;
    private $identifiant = "admin";
    private $motDePasse = "1234";
    private $nomBdd = "cine_lumiere";
    private $host = "localhost";

    public function __construct()
    {
        try {
            $this->connexionBdd = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->nomBdd,
                $this->identifiant,
                $this->motDePasse,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        } catch (Exception $e) {
            die("Erreur BDD : " . $e->getMessage());
        }
    }

    public function getConnexionBdd()
    {
        return $this->connexionBdd;
    }

}