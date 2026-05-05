<?php
require_once __DIR__ . '/../../repository/ReservationRepository.php';
require_once __DIR__ . '/../../repository/SeanceRepository.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /Cine_Lumiere/public/reservation/ajouter.php'); exit; }
$a = (int)($_POST['nbre_places_adulte']??0);
$s = (int)($_POST['nbre_places_senior']??0);
$e = (int)($_POST['nbre_places_etudiant']??0);
$refSeance = (int)($_POST['ref_seance']??0);
// CDC : au moins 1 place
if (($a+$s+$e) < 1) { header('Location: /Cine_Lumiere/public/reservation/ajouter.php?err='.urlencode('Au moins 1 place requise.')); exit; }
// CDC : vérification capacité
$seanceRepo = new SeanceRepository();
$seance = $seanceRepo->getById($refSeance);
if ($seance) {
    $restantes = $seanceRepo->getPlacesRestantes($refSeance, $seance['capacite_max']);
    if (($a+$s+$e) > $restantes) { header('Location: /Cine_Lumiere/public/reservation/ajouter.php?err='.urlencode("Capacité insuffisante. Reste : $restantes place(s).")); exit; }
}
(new ReservationRepository())->ajouter(['ref_seance'=>$refSeance,'nbre_places_adulte'=>$a,'nbre_places_senior'=>$s,'nbre_places_etudiant'=>$e,'mode_paiement'=>$_POST['mode_paiement']??'en ligne','etat'=>$_POST['etat']??'en attente','ref_utilisateur'=>1,'ref_code_promo'=>$_POST['ref_code_promo']?:null]);
header('Location: /Cine_Lumiere/public/reservation/liste.php?msg=ok'); exit;
