<?php

require_once "../bdd/Bdd.php";
require_once "../modele/Utilisateur.php";
require_once "../repository/UtilisateurRepository.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../public/formulaire_inscription.html");
    exit();
}

$prenom   = trim($_POST["prenom"] ?? "");
$nom      = trim($_POST["nom"] ?? "");
$email    = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");

if (empty($prenom) || empty($nom) || empty($email) || empty($password)) {
    $_SESSION["error"] = "Tous les champs sont obligatoires.";
    header("Location: ../../public/formulaire_inscription.html");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["error"] = "Email invalide.";
    header("Location: ../../public/formulaire_inscription.html");
    exit();
}

$mdp_hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $pdo = (new Bdd())->getConnexionBdd();
} catch (Exception $e) {
    die("Erreur BDD : " . $e->getMessage());
}
$utilisateurRepository = new UtilisateurRepository();
$utilisateur = $utilisateurRepository->getUtilisateurByEmail($email);

// Vérifier si l'email existe déjà
if (!is_null($utilisateur)) {
    $_SESSION["error"] = "Cet email est déjà utilisé.";
    header("Location: ../../public/formulaire_inscription.html");
    exit();
}
$utilisateur = new Utilisateur(null,$nom,$prenom,null,$email,null,null,$mdp_hash,"client",0);
$utilisateurRepository->ajouterUtilisateur($utilisateur);

// REDIRECTION OK
header("Location: ../../public/connexion.html");
exit();
