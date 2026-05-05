<?php
require_once __DIR__ . '/../../repository/FilmRepository.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ../../../public/film/liste.php'); exit; }
$id = (int)($_POST['id'] ?? 0);
if ($id) (new FilmRepository())->supprimer($id);
header('Location: ../../../public/film/liste.php?msg=ok'); exit;
