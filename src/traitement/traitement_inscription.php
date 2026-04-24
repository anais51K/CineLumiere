<?php
session_start();

// Vérifier que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../public/formulaire_inscription.html");
    exit();
}

// Récupération des données
$prenom   = trim($_POST["prenom"] ?? "");
$nom      = trim($_POST["nom"] ?? "");
$email    = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");

// Vérification des champs
if (empty($prenom) || empty($nom) || empty($email) || empty($password)) {
    $_SESSION["error"] = "Tous les champs sont obligatoires.";
    header("Location: ../../public/formulaire_inscription.html");
    exit();
}

// Vérification email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["error"] = "Email invalide.";
    header("Location: ../../public/formulaire_inscription.html");
    exit();
}

// Hash du mot de passe
$mdp_hash = password_hash($password, PASSWORD_DEFAULT);

// Connexion BDD
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=cine_lumiere;charset=utf8",
        "admin",
        "1234",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    $_SESSION["error"] = "Erreur de connexion à la base de données.";
    header("Location: ../../public/formulaire_inscription.html");
    exit();
}

// Vérifier si l'email existe déjà
$check = $pdo->prepare("SELECT id_utilisateur FROM utilisateur WHERE email = ?");
$check->execute([$email]);

if ($check->rowCount() > 0) {
    $_SESSION["error"] = "Cet email est déjà utilisé.";
    header("Location: ../../public/formulaire_inscription.html");
    exit();
}

// Insertion dans la base
$insert = $pdo->prepare("
    INSERT INTO utilisateur (nom, prenom, email, telephone, mdp, adresse, date_naissance, statut, gestion)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");

// Valeurs par défaut
$telephone = null;
$adresse = null;
$date_naissance = null;
$statut = 'client';
$gestion = 0;

$insert->execute([
    $nom,
    $prenom,
    $email,
    $telephone,
    $mdp_hash,
    $adresse,
    $date_naissance,
    $statut,
    $gestion
]);

// Succès
$_SESSION["success"] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
header("Location: ../../public/connexion.php");
exit();
