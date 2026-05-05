<?php
require_once '../../src/repository/SeanceRepository.php';
$id   = (int)($_GET['id'] ?? 0);
$repo = new SeanceRepository();
$s    = $repo->getById($id);
if (!$s) { header('Location: liste.php'); exit; }
?>
<?php include '../../src/includes/header.php'; ?>
<h2 class="page-title">Supprimer la séance</h2>
<div class="card-dark" style="max-width:500px">
    <p>Supprimer la séance <strong><?= htmlspecialchars($s['film_nom']??'') ?></strong> du <strong><?= substr($s['date'],0,10) ?></strong> ?</p>
    <form method="POST" action="/Cine_Lumiere/src/traitement/seance/supprimerSeanceTraitement.php" class="d-flex gap-2">
        <input type="hidden" name="id" value="<?= $s['id_seance'] ?>">
        <button type="submit" class="btn btn-del">Oui, supprimer</button>
        <a href="liste.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<?php include '../../src/includes/footer.php'; ?>
