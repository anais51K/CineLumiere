<?php
require_once __DIR__ . '/../../repository/SalleRepository.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /Cine_Lumiere/public/salle/liste.php'); exit; }
$id   = (int)($_POST['id'] ?? 0);
$code = trim($_POST['code'] ?? '');
$cap  = (int)($_POST['capacite_max'] ?? 0);
if (!$id || !$code || $cap < 1) { header('Location: /Cine_Lumiere/public/salle/modifier.php?id='.$id.'&err='.urlencode('Code et capacité obligatoires.')); exit; }
(new SalleRepository())->modifier($id,['code'=>$code,'capacite_max'=>$cap,'etat'=>$_POST['etat']]);
header('Location: /Cine_Lumiere/public/salle/liste.php?msg=ok'); exit;
