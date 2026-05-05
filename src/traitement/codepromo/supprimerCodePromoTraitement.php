<?php
require_once __DIR__ . '/../../repository/CodePromoRepository.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /Cine_Lumiere/public/codepromo/liste.php'); exit; }
$id = (int)($_POST['id']??0);
if ($id) (new CodePromoRepository())->supprimer($id);
header('Location: /Cine_Lumiere/public/codepromo/liste.php?msg=ok'); exit;
