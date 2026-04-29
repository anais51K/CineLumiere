<?php
session_start();

// On encode toutes les données envoyées depuis la page précédente
$data = base64_encode(json_encode($_POST));

// 🔵 Si l'utilisateur n'est PAS connecté → on l'envoie vers connexion.html
// avec redirect_data pour revenir ensuite vers recap_paiement
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: ../../public/connexion.html?redirect_data=" . $data);
    exit;
}

// 🔵 Si l'utilisateur est déjà connecté → on va directement vers recap_paiement
header("Location: ../../public/recapitulatif_achat?data=" . $data);
exit;

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    die("Utilisateur non connecté.");
}

// Vérifier que les données existent
if (!isset($_POST['data'])) {
    die("Aucune donnée reçue.");
}

// Décoder les données envoyées depuis recap_paiement.php
$data = json_decode(base64_decode($_POST['data']), true);

// Récupération des valeurs
$jour = $data['jour'];
$horaire = $data['horaire'];
$nb_adulte = $data['nb_adulte'];
$nb_etudiant = $data['nb_etudiant'];
$nb_senior = $data['nb_senior'];
$ref_seance = $data['ref_seance']; // doit être envoyé depuis tarifs/verif_connexion

// Tarifs
$tarif_adulte = 9.50;
$tarif_etudiant = 7.00;
$tarif_senior = 6.00;

// Calcul du total
$total = ($nb_adulte * $tarif_adulte)
    + ($nb_etudiant * $tarif_etudiant)
    + ($nb_senior * $tarif_senior);

// Code promo (optionnel)
$code_promo = !empty($_POST['code_promo']) ? $_POST['code_promo'] : null;

// Connexion BDD
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

// Insertion en base
$sql = "INSERT INTO reservation 
        (nbre_places_senior, nbre_places_etudiant, nbre_places_adulte, etat, mode_paiement, ref_utilisateur, ref_seance, ref_code_promo, total)
        VALUES (:senior, :etudiant, :adulte, 'en_attente', 'carte', :user, :seance, :code, :total)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':senior' => $nb_senior,
    ':etudiant' => $nb_etudiant,
    ':adulte' => $nb_adulte,
    ':user' => $_SESSION['id_utilisateur'],
    ':seance' => $ref_seance,
    ':code' => $code_promo,
    ':total' => $total
]);

// Redirection vers confirmation
header("Location: ../../public/confirmation_reservation.php");
exit;
