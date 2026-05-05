<?php
require_once __DIR__ . '/../../repository/ReservationRepository.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ../../../public/reservation/liste.php'); exit; }
$id = (int)($_POST['id']??0);
$r  = (new ReservationRepository())->getById($id);
if (!$r || $r['etat']==='confirmée') { header('Location: ../../../public/reservation/liste.php?msg=err'); exit; }
$a = (int)($_POST['nbre_places_adulte']??0);
$s = (int)($_POST['nbre_places_senior']??0);
$e = (int)($_POST['nbre_places_etudiant']??0);
if (($a+$s+$e) < 1) { header('Location: ../../../public/reservation/modifier.php?id='.$id.'&err='.urlencode('Au moins 1 place requise.')); exit; }
(new ReservationRepository())->modifier($id,['ref_seance'=>(int)($_POST['ref_seance']??$r['ref_seance']),'nbre_places_adulte'=>$a,'nbre_places_senior'=>$s,'nbre_places_etudiant'=>$e,'mode_paiement'=>$_POST['mode_paiement'],'etat'=>$_POST['etat'],'ref_code_promo'=>$_POST['ref_code_promo']?:null]);
header('Location: ../../../public/reservation/liste.php?msg=ok'); exit;
