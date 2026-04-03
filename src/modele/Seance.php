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


}