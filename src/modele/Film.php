<?php


class Film{
    private $idFilm;
    private $nom;
    private $duree;
    private $affiche;
    private $genre;
    private $ageMin;
    private $realisateur;
    private $dateSortie;
    private $bandeAnnonce;
    private $resume;

    /**
     * @param $idFilm
     * @param $nom
     * @param $duree
     * @param $affiche
     * @param $genre
     * @param $age_min
     * @param $realisateur
     * @param $dateSortie
     * @param $bandeAnnonce
     * @param $resume
     */
    public function __construct($idFilm, $nom, $duree, $affiche, $genre, $age_min, $realisateur, $dateSortie, $bandeAnnonce, $resume)
    {
        $this->resume = $resume;
        $this->bandeAnnonce = $bandeAnnonce;
        $this->dateSortie = $dateSortie;
        $this->realisateur = $realisateur;
        $this->ageMin = $age_min;
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
     * @param mixed $idFilm
     */
    public function setIdFilm($idFilm)
    {
        $this->idFilm = $idFilm;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * @return mixed
     */
    public function getAffiche()
    {
        return $this->affiche;
    }

    /**
     * @param mixed $affiche
     */
    public function setAffiche($affiche)
    {
        $this->affiche = $affiche;
    }

    /**
     * @return mixed
     */
    public function getAgeMin()
    {
        return $this->ageMin;
    }

    /**
     * @param mixed $ageMin
     */
    public function setAgeMin($ageMin)
    {
        $this->ageMin = $ageMin;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getRealisateur()
    {
        return $this->realisateur;
    }

    /**
     * @param mixed $realisateur
     */
    public function setRealisateur($realisateur)
    {
        $this->realisateur = $realisateur;
    }

    /**
     * @return mixed
     */
    public function getDateSortie()
    {
        return $this->dateSortie;
    }

    /**
     * @param mixed $dateSortie
     */
    public function setDateSortie($dateSortie)
    {
        $this->dateSortie = $dateSortie;
    }

    /**
     * @return mixed
     */
    public function getBandeAnnonce()
    {
        return $this->bandeAnnonce;
    }

    /**
     * @param mixed $bandeAnnonce
     */
    public function setBandeAnnonce($bandeAnnonce)
    {
        $this->bandeAnnonce = $bandeAnnonce;
    }

    /**
     * @return mixed
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @param mixed $resume
     */
    public function setResume($resume)
    {
        $this->resume = $resume;
    }





}