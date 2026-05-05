<?php
require_once __DIR__ . '/../../repository/SeanceRepository.php';
require_once __DIR__ . '/../../repository/SalleRepository.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ../../../public/seance/liste.php'); exit; }
$id       = (int)($_POST['id'] ?? 0);
$date     = $_POST['date'] ?? '';
$refFilm  = (int)($_POST['ref_film'] ?? 0);
$refSalle = (int)($_POST['ref_salle'] ?? 0);
$etat     = $_POST['etat'] ?? 'programmée';
$repo = new SeanceRepository();
// CDC : interdiction si réservations
if ($repo->aDesReservations($id)) { header('Location: ../../../public/seance/liste.php?msg=reservee'); exit; }
// CDC : pas dans le passé ni le jour même
if (!$date || strtotime($date) <= strtotime('today')) {
    header('Location: ../../../public/seance/modifier.php?id='.$id.'&err='.urlencode('La date doit être au minimum demain.')); exit;
}
// CDC : 1 séance par salle par jour (on exclut la séance actuelle)
if ((new SalleRepository())->estOccupee($refSalle, $date, $id)) {
    header('Location: ../../../public/seance/modifier.php?id='.$id.'&err='.urlencode('Cette salle est déjà occupée ce jour-là.')); exit;
}
$repo->modifier($id,['date'=>$date,'ref_film'=>$refFilm,'ref_salle'=>$refSalle,'etat'=>$etat]);
header('Location: ../../../public/seance/liste.php?msg=ok'); exit;
