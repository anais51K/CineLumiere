<?php

namespace traitement;

require_once "src/bdd/Bdd.php";
require_once '../modele/CodePromo.php';

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