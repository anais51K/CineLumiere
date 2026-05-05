<?php
require_once '../../src/repository/FilmRepository.php';
$id = (int)($_GET['id'] ?? 0);
$f  = (new FilmRepository())->getById($id);
if (!$f) { header('Location: liste.php'); exit; }
$err = $_GET['err'] ?? '';
?>
<?php include '../../src/includes/header.php'; ?>
<h2 class="page-title">Modifier le film</h2>
<?php if($err): ?><div class="msg-err"><?= htmlspecialchars($err) ?></div><?php endif; ?>
<div class="card-dark" style="max-width:700px">
<form method="POST" action="/Cine_Lumiere/src/traitement/film/modifierFilmTraitement.php">
    <input type="hidden" name="id" value="<?= $f['id_film'] ?>">
    <div class="row g-3">
        <div class="col-md-8"><label class="form-label">Nom *</label><input class="form-control" name="nom" value="<?= htmlspecialchars($f['nom']) ?>" required></div>
        <div class="col-md-4"><label class="form-label">Durée (min) *</label><input class="form-control" type="number" name="duree" min="1" value="<?= $f['duree'] ?>" required></div>
        <div class="col-md-5"><label class="form-label">Genre</label><input class="form-control" name="genre" value="<?= htmlspecialchars($f['genre']??'') ?>"></div>
        <div class="col-md-4"><label class="form-label">Réalisateur</label><input class="form-control" name="realisateur" value="<?= htmlspecialchars($f['realisateur']??'') ?>"></div>
        <div class="col-md-3"><label class="form-label">Âge minimum</label><input class="form-control" type="number" name="age_min" min="0" value="<?= $f['age_min'] ?>"></div>
        <div class="col-md-4"><label class="form-label">Date de sortie</label><input class="form-control" type="date" name="date_sortie" value="<?= $f['date_sortie']??'' ?>"></div>
        <div class="col-md-8"><label class="form-label">URL Affiche</label><input class="form-control" name="affiche" value="<?= htmlspecialchars($f['affiche']??'') ?>"></div>
        <div class="col-12"><label class="form-label">URL Bande-annonce</label><input class="form-control" name="bande_annonce" value="<?= htmlspecialchars($f['bande_annonce']??'') ?>"></div>
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-cl"><i class="bi bi-check-lg me-1"></i>Enregistrer</button>
            <a href="liste.php" class="btn btn-secondary">Annuler</a>
        </div>
    </div>
</form>
</div>
<?php include '../../src/includes/footer.php'; ?>
