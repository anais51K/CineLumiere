<?php
require_once __DIR__ . '/../../repository/SalleRepository.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ../../../public/salle/ajouter.php'); exit; }
$code = trim($_POST['code'] ?? '');
$cap  = (int)($_POST['capacite_max'] ?? 0);
if (!$code || $cap < 1) { header('Location: ../../../public/salle/ajouter.php?err='.urlencode('Code et capacité obligatoires.')); exit; }
(new SalleRepository())->ajouter(['code'=>$code,'capacite_max'=>$cap,'etat'=>$_POST['etat']??'disponible']);
header('Location: ../../../public/salle/liste.php?msg=ok'); exit;
