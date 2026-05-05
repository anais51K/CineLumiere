<?php $err = $_GET['err'] ?? ''; ?>
<?php include '../../src/includes/header.php'; ?>
<h2 class="page-title">Ajouter un film</h2>
<?php if($err): ?><div class="msg-err"><?= htmlspecialchars($err) ?></div><?php endif; ?>
<div class="card-dark" style="max-width:700px">
<form method="POST" action="/Cine_Lumiere/src/traitement/film/ajouterFilmTraitement.php">
    <div class="row g-3">
        <div class="col-md-8"><label class="form-label">Nom *</label><input class="form-control" name="nom" required></div>
        <div class="col-md-4"><label class="form-label">Durée (min) *</label><input class="form-control" type="number" name="duree" min="1" required></div>
        <div class="col-md-5"><label class="form-label">Genre</label><input class="form-control" name="genre"></div>
        <div class="col-md-4"><label class="form-label">Réalisateur</label><input class="form-control" name="realisateur"></div>
        <div class="col-md-3"><label class="form-label">Âge minimum</label><input class="form-control" type="number" name="age_min" min="0" value="0"></div>
        <div class="col-md-4"><label class="form-label">Date de sortie</label><input class="form-control" type="date" name="date_sortie"></div>
        <div class="col-md-8"><label class="form-label">URL Affiche</label><input class="form-control" name="affiche"></div>
        <div class="col-12"><label class="form-label">URL Bande-annonce</label><input class="form-control" name="bande_annonce"></div>
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-cl"><i class="bi bi-check-lg me-1"></i>Enregistrer</button>
            <a href="liste.php" class="btn btn-secondary">Annuler</a>
        </div>
    </div>
</form>
</div>
<?php include '../../src/includes/footer.php'; ?>
