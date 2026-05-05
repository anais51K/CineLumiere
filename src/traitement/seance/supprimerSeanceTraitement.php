<?php
require_once __DIR__ . '/../../repository/SeanceRepository.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ../../../public/seance/liste.php'); exit; }
$id   = (int)($_POST['id'] ?? 0);
$repo = new SeanceRepository();
if ($repo->aDesReservations($id)) { header('Location: ../../../public/seance/liste.php?msg=reservee'); exit; }
if ($id) $repo->supprimer($id);
header('Location: ../../../public/seance/liste.php?msg=ok'); exit;
