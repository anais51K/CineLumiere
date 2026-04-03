<?php

namespace modele;

class Seance{
    private $idSeance;
    private $date;
    private $etat;

    /**
     * @param $idSeance
     * @param $date
     * @param $etat
     */
    public function __construct($idSeance, $date, $etat)
    {
        $this->idSeance = $idSeance;
        $this->date = $date;
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getIdSeance()
    {
        return $this->idSeance;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $idSeance
     */
    public function setIdSeance($idSeance)
    {
        $this->idSeance = $idSeance;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }


}