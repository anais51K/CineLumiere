<?php
require_once '../../src/repository/FilmRepository.php';
$id = (int)($_GET['id'] ?? 0);
$f  = (new FilmRepository())->getById($id);
if (!$f) { header('Location: liste.php'); exit; }
?>
<?php include '../../src/includes/header.php'; ?>
<h2 class="page-title">Supprimer le film</h2>
<div class="card-dark" style="max-width:500px">
    <p>Supprimer <strong><?= htmlspecialchars($f['nom']) ?></strong> définitivement ?</p>
    <form method="POST" action="/Cine_Lumiere/src/traitement/film/supprimerFilmTraitement.php" class="d-flex gap-2">
        <input type="hidden" name="id" value="<?= $f['id_film'] ?>">
        <button type="submit" class="btn btn-del">Oui, supprimer</button>
        <a href="liste.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<?php include '../../src/includes/footer.php'; ?>
