<?php
session_start();

// Vérifie que la requête est bien en POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../public/connexion.html");
    exit();
}

// Récupération des champs
$email = trim($_POST["email"] ?? "");
$mdp   = trim($_POST["password"] ?? "");

// Vérification des champs vides
if (empty($email) || empty($mdp)) {
    $_SESSION["error"] = "Veuillez remplir tous les champs.";
    header("Location: ../../public/connexion.html");
    exit();
}

// Connexion à la base
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=cine_lumiere;charset=utf8",
        "admin", "1234",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    $_SESSION["error"] = "Erreur de connexion à la base de données.";
    header("Location: ../../public/connexion.html");
    exit();
}

// Vérification de l'utilisateur
$req = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
$req->execute([$email]);
$user = $req->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($mdp, $user["mdp"])) {
    $_SESSION["error"] = "Email ou mot de passe incorrect.";
    header("Location: ../../public/connexion.html");
    exit();
}

// Connexion réussie → stockage session
$_SESSION["id_utilisateur"] = $user["id_utilisateur"];
$_SESSION["user"] = [
    "id"     => $user["id_utilisateur"],
    "nom"    => $user["nom"],
    "prenom" => $user["prenom"],
];

// 🔵 Si redirect_data est présent → retour au tunnel de réservation
if (!empty($_GET["redirect_data"])) {
    header("Location: ../../public/recapitulatif_achat.html?data=" . urlencode($_GET["redirect_data"]));
    exit();
}

// 🔵 Sinon → accueil
header("Location: ../../public/accueil.html");
exit();
