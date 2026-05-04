<?php

require_once "../bdd/Bdd.php";
require_once "../modele/Utilisateur.php";
require_once "../repository/UtilisateurRepository.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../public/accueil.php");
    exit();
}

$email   = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");

if (empty($email) || empty($message)) {
    $_SESSION["error"] = "Tous les champs sont obligatoires.";
    header("Location: ../../public/accueil.php");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["error"] = "Email invalide.";
    header("Location: ../../public/accueil.php");
    exit();
}

try {
    $pdo = (new Bdd())->getConnexionBdd();
} catch (Exception $e) {
    die("Erreur BDD : " . $e->getMessage());
}

$insert = $pdo->prepare("
    INSERT INTO contact (email, message)
    VALUES (:email, :message)
");

$insert->execute([
    ":email"   => $email,
    ":message" => $message
]);

$_SESSION["success"] = "Votre message a bien été envoyé !";
header("Location: ../../public/accueil.php");
exit();

