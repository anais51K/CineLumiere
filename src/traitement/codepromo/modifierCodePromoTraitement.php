<?php
require_once __DIR__ . '/../../repository/CodePromoRepository.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /Cine_Lumiere/public/codepromo/liste.php'); exit; }
$id   = (int)($_POST['id']??0);
$code = strtoupper(trim($_POST['code']??''));
if (!$id || !$code) { header('Location: /Cine_Lumiere/public/codepromo/modifier.php?id='.$id.'&err='.urlencode('Code obligatoire.')); exit; }
(new CodePromoRepository())->modifier($id,['code'=>$code,'pourcentage'=>$_POST['pourcentage'],'etat'=>$_POST['etat']]);
header('Location: /Cine_Lumiere/public/codepromo/liste.php?msg=ok'); exit;
