<?php
require_once '../../src/repository/FilmRepository.php';
$films = (new FilmRepository())->getAll();
$msg = $_GET['msg'] ?? '';
?>
<?php include '../../src/includes/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title mb-0">Films <span class="badge bg-secondary ms-2"><?= count($films) ?></span></h2>
    <a href="ajouter.php" class="btn btn-cl btn-sm"><i class="bi bi-plus-lg me-1"></i>Ajouter</a>
</div>
<?php if($msg==='ok'): ?><div class="msg-ok"><i class="bi bi-check-circle me-1"></i>Opération réussie.</div><?php endif; ?>
<?php if($msg==='err'): ?><div class="msg-err"><i class="bi bi-x-circle me-1"></i>Une erreur est survenue.</div><?php endif; ?>
<div class="card-dark p-0">
<table class="table table-cl table-hover mb-0">
    <thead><tr><th class="ps-3">Nom</th><th>Genre</th><th>Réalisateur</th><th>Durée</th><th>Âge min.</th><th>Date sortie</th><th>Actions</th></tr></thead>
    <tbody>
    <?php if(empty($films)): ?>
        <tr><td colspan="7" class="text-center text-secondary py-4">Aucun film enregistré.</td></tr>
    <?php else: foreach($films as $f): ?>
        <tr>
            <td class="ps-3"><strong><?= htmlspecialchars($f['nom']) ?></strong></td>
            <td><?= htmlspecialchars($f['genre'] ?? '—') ?></td>
            <td><?= htmlspecialchars($f['realisateur'] ?? '—') ?></td>
            <td><?= $f['duree'] ?> min</td>
            <td><?= $f['age_min'] ?>+</td>
            <td><?= $f['date_sortie'] ?? '—' ?></td>
            <td>
                <a href="modifier.php?id=<?= $f['id_film'] ?>" class="btn btn-edit me-1"><i class="bi bi-pencil"></i></a>
                <a href="supprimer.php?id=<?= $f['id_film'] ?>" class="btn btn-del"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; endif; ?>
    </tbody>
</table>
</div>
<?php include '../../src/includes/footer.php'; ?>
