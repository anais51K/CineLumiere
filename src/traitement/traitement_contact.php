<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../public/accueil.html");
    exit();
}

$email   = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");

if (empty($email) || empty($message)) {
    $_SESSION["error"] = "Tous les champs sont obligatoires.";
    header("Location: ../../public/accueil.html");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["error"] = "Email invalide.";
    header("Location: ../../public/accueil.html");
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
header("Location: ../../public/accueil.html");
exit();

