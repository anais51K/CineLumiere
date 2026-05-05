<?php
require_once __DIR__ . '/../../repository/FilmRepository.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ../../../public/film/ajouter.php'); exit; }
$nom   = trim($_POST['nom'] ?? '');
$duree = (int)($_POST['duree'] ?? 0);
if (!$nom || $duree < 1) {
    header('Location: ../../../public/film/ajouter.php?err=' . urlencode('Nom et durée obligatoires.')); exit;
}
(new FilmRepository())->ajouter(['nom'=>$nom,'duree'=>$duree,'genre'=>trim($_POST['genre']??'')?:null,'age_min'=>(int)($_POST['age_min']??0),'realisateur'=>trim($_POST['realisateur']??'')?:null,'date_sortie'=>$_POST['date_sortie']?:null,'affiche'=>trim($_POST['affiche']??'')?:null,'bande_annonce'=>trim($_POST['bande_annonce']??'')?:null]);
header('Location: ../../../public/film/liste.php?msg=ok'); exit;
