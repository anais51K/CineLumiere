<?php

namespace modele;

class Salle{
    private $idSalle;
    private $capaciteMax;
    private $code;
    private $etat;

    /**
     * @param $idSalle
     * @param $capaciteMax
     * @param $code
     * @param $etat
     */
    public function __construct($idSalle, $capaciteMax, $code, $etat)
    {
        $this->idSalle = $idSalle;
        $this->capaciteMax = $capaciteMax;
        $this->code = $code;
        $this->etat = $etat;
    }


}