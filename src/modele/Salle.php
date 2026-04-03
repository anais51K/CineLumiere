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

    /**
     * @return mixed
     */
    public function getIdSalle()
    {
        return $this->idSalle;
    }

    /**
     * @return mixed
     */
    public function getCapaciteMax()
    {
        return $this->capaciteMax;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $idSalle
     */
    public function setIdSalle($idSalle)
    {
        $this->idSalle = $idSalle;
    }

    /**
     * @param mixed $capaciteMax
     */
    public function setCapaciteMax($capaciteMax)
    {
        $this->capaciteMax = $capaciteMax;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }


}