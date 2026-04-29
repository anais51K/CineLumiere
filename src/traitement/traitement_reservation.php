<?php
session_start();

if (!isset($_SESSION['id_utilisateur'])) {
    // Sauvegarder les données POST en session avant de rediriger
    $_SESSION['pending_reservation'] = [
        'data'       => $_POST['data'] ?? '',
        'code_promo' => $_POST['code_promo'] ?? ''
    ];
    header("Location: ../../public/connexion.php");
    exit;
}

// Si retour après connexion, récupérer les données sauvegardées en session
if (empty($_POST['data']) && isset($_SESSION['pending_reservation'])) {
    $_POST['data']       = $_SESSION['pending_reservation']['data'];
    $_POST['code_promo'] = $_SESSION['pending_reservation']['code_promo'];
    unset($_SESSION['pending_reservation']);
}

$data = json_decode(base64_decode($_POST['data'] ?? ''), true);
if (!$data) { die("Données invalides."); }

$jour        = $data['jour'];
$horaire     = $data['horaire'];
$ref_seance  = $data['ref_seance'];
$nb_adulte   = (int)($data['nb_adulte']   ?? 0);
$nb_etudiant = (int)($data['nb_etudiant'] ?? 0);
$nb_senior   = (int)($data['nb_senior']   ?? 0);
$code_promo  = !empty($_POST['code_promo']) ? $_POST['code_promo'] : null;

$total = ($nb_adulte * 9.50) + ($nb_etudiant * 7.00) + ($nb_senior * 6.00);

try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=cine_lumiere;charset=utf8",
        "admin", "1234",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    die("Erreur BDD : " . $e->getMessage());
}

$sql = "INSERT INTO reservation 
        (nbre_places_senior, nbre_places_etudiant, nbre_places_adulte, 
         etat, mode_paiement, ref_utilisateur, ref_seance, ref_code_promo, total)
        VALUES (:senior, :etudiant, :adulte, 'confirmee', 'carte', 
                :user, :seance, :code, :total)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':senior'   => $nb_senior,
    ':etudiant' => $nb_etudiant,
    ':adulte'   => $nb_adulte,
    ':user'     => $_SESSION['id_utilisateur'],
    ':seance'   => $ref_seance,
    ':code'     => $code_promo,
    ':total'    => $total
]);

$_SESSION['confirmation'] = [
    'jour'    => $jour,
    'horaire' => $horaire,
    'total'   => $total
];
header("Location: ../../public/confirmation.php");
exit;