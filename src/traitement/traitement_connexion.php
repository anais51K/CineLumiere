<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../public/connexion.html");
    exit();
}

$email = trim($_POST["email"] ?? "");
$mdp = trim($_POST["password"] ?? ""); // <-- OK

// ICI : on vérifie $mdp, pas $password !
if (empty($email) || empty($mdp)) {
    $_SESSION["error"] = "Veuillez remplir tous les champs.";
    header("Location: ../public/connexion.html");
    exit();
}

try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=cine_lumiere;charset=utf8",
        "admin",
        "1234",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    $_SESSION["error"] = "Erreur de connexion à la base de données.";
    header("Location: ../public/connexion.html");
    exit();
}

$req = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
$req->execute([$email]);
$user = $req->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($mdp, $user["mdp"])) {
    $_SESSION["error"] = "Email ou mot de passe incorrect.";
    header("Location: ../public/connexion.html");
    exit();
}

// Connexion réussie
$_SESSION["user"] = [
    "id" => $user["id_utilisateur"],
    "nom" => $user["nom"],
    "prenom" => $user["prenom"],
    "statut" => $user["statut"],
    "gestion" => $user["gestion"]
];

// Redirection vers la page d'accueil
header("Location: ../../public/accueil.html");
exit();


