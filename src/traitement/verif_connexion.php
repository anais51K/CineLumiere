<?php
session_start();

$data = base64_encode(json_encode($_POST));

// 🔵 Si l'utilisateur n'est PAS connecté → on l'envoie vers connexion.html
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: ../../public/connexion.html?redirect_data=" . $data);
    exit;
}

// 🔵 Si l'utilisateur est connecté → on va vers recap_paiement.php
header("Location: ../../public/recap_paiement.php?data=" . $data);
exit;
