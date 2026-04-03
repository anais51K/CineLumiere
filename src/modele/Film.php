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

    /**
     * @return mixed
     */
    public function getIdFilm()
    {
        return $this->idFilm;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @return mixed
     */
    public function getAffiche()
    {
        return $this->affiche;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @return mixed
     */
    public function getAgeMin()
    {
        return $this->age_min;
    }

    /**
     * @return mixed
     */
    public function getRealisateur()
    {
        return $this->realisateur;
    }

    /**
     * @return mixed
     */
    public function getDateSortie()
    {
        return $this->dateSortie;
    }

    /**
     * @return mixed
     */
    public function getBandeAnnonce()
    {
        return $this->bandeAnnonce;
    }




}