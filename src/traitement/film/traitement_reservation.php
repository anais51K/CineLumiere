<?php

session_start();
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

// 1. Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: ../connexion.php?error=not_logged");
    exit;
}

// 2. Vérifier que le formulaire a été envoyé
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    exit;
}

// 3. Récupérer les données du formulaire
$ref_seance = $_POST['ref_seance'] ?? null;
$date = $_POST['date'] ?? null;
$heure = $_POST['heure'] ?? null;
$nbre_adulte = $_POST['nbre_places_adulte'] ?? 0;

if (empty($ref_seance) || empty($date) || empty($heure)) {
    header("Location: ../index.php?error=missing_fields");
    exit;
}

// 4. Construire la date complète (format DATETIME)
$date_heure = $date . " " . $heure . ":00";

// ⚠️ Ta table reservation n'a PAS de colonne date_heure.
// Donc on suppose que la date/heure appartient à la séance.
// Si tu veux la stocker dans reservation, je te fais la colonne.

// 5. Insertion dans la table reservation
$sql = "INSERT INTO reservation (
            nbre_places_senior,
            nbre_places_etudiant,
            nbre_places_adulte,
            etat,
            mode_paiement,
            ref_utilisateur,
            ref_seance,
            ref_code_promo
        ) VALUES (
            0, 0, :adulte, 'en_attente', 'non_defini',
            :ref_utilisateur, :ref_seance, NULL
        )";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':adulte' => $nbre_adulte,
    ':ref_utilisateur' => $_SESSION['id_utilisateur'],
    ':ref_seance' => $ref_seance
]);

// 6. Redirection après succès
header("Location: ../confirmation_reservation.php?success=1");
exit;
