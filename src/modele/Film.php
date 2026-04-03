<?php

namespace modele;

class Film{
    private $idFilm;
    private $nom;
    private $duree;
    private $affiche;
    private $genre;
    private $age_min;
    private $realisateur;
    private $dateSortie;
    private $bandeAnnonce;

    /**
     * @param $bandeAnnonce
     * @param $dateSortie
     * @param $realisateur
     * @param $age_min
     * @param $genre
     * @param $affiche
     * @param $duree
     * @param $nom
     * @param $idFilm
     */
    public function __construct($bandeAnnonce, $dateSortie, $realisateur, $age_min, $genre, $affiche, $duree, $nom, $idFilm)
    {
        $this->bandeAnnonce = $bandeAnnonce;
        $this->dateSortie = $dateSortie;
        $this->realisateur = $realisateur;
        $this->age_min = $age_min;
        $this->genre = $genre;
        $this->affiche = $affiche;
        $this->duree = $duree;
        $this->nom = $nom;
        $this->idFilm = $idFilm;
    }


}