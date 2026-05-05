<?php
require_once __DIR__ . '/../../repository/CodePromoRepository.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ../../../public/codepromo/ajouter.php'); exit; }
$code = strtoupper(trim($_POST['code']??''));
if (!$code) { header('Location: ../../../public/codepromo/ajouter.php?err='.urlencode('Le code est obligatoire.')); exit; }
$repo = new CodePromoRepository();
if ($repo->getByCode($code)) { header('Location: ../../../public/codepromo/liste.php?msg=doublon'); exit; }
$repo->ajouter(['code'=>$code,'pourcentage'=>$_POST['pourcentage'],'etat'=>$_POST['etat']??'actif']);
header('Location: ../../../public/codepromo/liste.php?msg=ok'); exit;
