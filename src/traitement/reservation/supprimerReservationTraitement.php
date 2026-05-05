<?php
require_once __DIR__ . '/../../repository/ReservationRepository.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ../../../public/reservation/liste.php'); exit; }
$id = (int)($_POST['id']??0);
if ($id) (new ReservationRepository())->supprimer($id);
header('Location: ../../../public/reservation/liste.php?msg=ok'); exit;
