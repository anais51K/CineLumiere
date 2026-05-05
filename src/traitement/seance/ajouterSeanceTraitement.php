<?php
require_once __DIR__ . '/../../repository/SeanceRepository.php';
require_once __DIR__ . '/../../repository/SalleRepository.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /Cine_Lumiere/public/seance/ajouter.php'); exit; }
$date     = $_POST['date'] ?? '';
$refFilm  = (int)($_POST['ref_film'] ?? 0);
$refSalle = (int)($_POST['ref_salle'] ?? 0);
// CDC §5.4 : pas dans le passé ni le jour même
if (!$date || strtotime($date) <= strtotime('today')) {
    header('Location: /Cine_Lumiere/public/seance/ajouter.php?err='.urlencode('La date doit être au minimum demain.')); exit;
}
// CDC : 1 séance par salle par jour
if ((new SalleRepository())->estOccupee($refSalle, $date)) {
    header('Location: /Cine_Lumiere/public/seance/ajouter.php?err='.urlencode('Cette salle est déjà occupée ce jour-là.')); exit;
}
(new SeanceRepository())->ajouter(['date'=>$date,'ref_film'=>$refFilm,'ref_salle'=>$refSalle]);
header('Location: /Cine_Lumiere/public/seance/liste.php?msg=ok'); exit;
