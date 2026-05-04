<?php

require_once "../bdd/Bdd.php";
require_once '../modele/CodePromo.php';
require_once '../repository/CodePromoRepository.php';

class NewCodePromo {

    public function __construct() {
        if (isset($_POST['codePromo']) && isset($_POST['pourcentageReduction'])) {
            $codePromo = new CodePromo(
                null,
                $_POST['codePromo'],
                $_POST['pourcentageReduction'],
                true
            );
        }
    }
}