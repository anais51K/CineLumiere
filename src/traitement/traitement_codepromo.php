<?php
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=cine_lumiere;charset=utf8",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (!isset($_POST['code']) || !isset($_POST['discount'])) {
    die("Erreur : données manquantes.");
}

$code = strtoupper(trim($_POST['code']));
$discount = intval($_POST['discount']);

// Vérifier si le code existe déjà
$check = $pdo->prepare("SELECT id_code_promo FROM code_promo WHERE code = ?");
$check->execute([$code]);

if ($check->rowCount() > 0) {
    die("❌ Ce code promo existe déjà.");
}

// Insertion
$insert = $pdo->prepare("
    INSERT INTO code_promo (code, pourcentage, etat)
    VALUES (?, ?, 1)
");
$insert->execute([$code, $discount]);

// 🔥 REDIRECTION APRÈS SUCCÈS
header("Location: /CineLumiere/public/offre.html?success=1");
exit;

