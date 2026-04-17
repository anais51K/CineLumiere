<?php
session_start();

// 1. Connexion à la base de données
$host = "localhost";
$dbname = "cine_lumiere";
$username = "admin";
$password = "1234";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

//récupère tout
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../public/formulaire_inscription.html");
    exit;
}

$prenom     = trim($_POST["prenom"] );
$nom        = trim($_POST["nom"]  );
$email      = trim($_POST["email"] );
$motDePasse = trim($_POST["password"] );

//recuperation avec vérification que tout les champs sont remplis
if (empty($prenom) || empty($nom) || empty($email) || empty($motDePasse)) {
    $_SESSION['error'] = "Tous les champs sont obligatoires.";
    header("Location: ../public/formulaire_inscription.html");
    exit;
}

$hash = password_hash($motDePasse, PASSWORD_DEFAULT);

//envoie vers la bdd
$sql = "INSERT INTO users (prenom, nom, email, hash) VALUES (:prenom, :nom, :email, :hash)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        ":prenom" => $prenom,
        ":nom"    => $nom,
        ":email"  => $email,
        ":hash"   => $hash
    ]);

    $_SESSION['success'] = "Inscription réussie ";
    header("Location: ../public/connexion.html");
    exit;

} catch (PDOException $e) {

    //verifier si email deja utilisé ou pas pour un compte deja existant
    if ($e->getCode() == 23000) {
        $_SESSION['error'] = "Cet email est déjà utilisé.";
    } else {
        $_SESSION['error'] = "Erreur : " . $e->getMessage();
    }
    header("Location: ../public/formulaire_inscription.html");
    exit;
}