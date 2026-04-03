<?php

namespace repository;

class ReservationRepository
{
    private $connexionBdd;
    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }
    Public function GetReservation(idRersveration)
    {

    }

}