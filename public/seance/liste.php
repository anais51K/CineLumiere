<?php
require_once '../../src/repository/SeanceRepository.php';
$repo   = new SeanceRepository();
$seances = $repo->getAll();
$msg = $_GET['msg'] ?? '';
$col = ['programmée'=>'#1d4ed8','en cours'=>'#065f46','terminée'=>'#374151','annulée'=>'#7f1d1d'];
?>
<?php include '../../src/includes/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title mb-0">Séances <span class="badge bg-secondary ms-2"><?= count($seances) ?></span></h2>
    <a href="ajouter.php" class="btn btn-cl btn-sm"><i class="bi bi-plus-lg me-1"></i>Programmer</a>
</div>
<?php if($msg==='ok'): ?><div class="msg-ok">Opération réussie.</div><?php endif; ?>
<?php if($msg==='reservee'): ?><div class="msg-err">Impossible : cette séance a des réservations (CDC §5.4).</div><?php endif; ?>
<?php if($msg==='err'): ?><div class="msg-err">Erreur.</div><?php endif; ?>
<div class="card-dark p-0">
<table class="table table-cl table-hover mb-0">
    <thead><tr><th class="ps-3">Film</th><th>Salle</th><th>Date</th><th>État</th><th>Places restantes</th><th>Actions</th></tr></thead>
    <tbody>
    <?php if(empty($seances)): ?>
        <tr><td colspan="6" class="text-center text-secondary py-4">Aucune séance.</td></tr>
    <?php else: foreach($seances as $s):
        $restantes = $repo->getPlacesRestantes($s['id_seance'], $s['capacite_max']);
    ?>
        <tr>
            <td class="ps-3"><strong><?= htmlspecialchars($s['film_nom']??'—') ?></strong></td>
            <td><?= htmlspecialchars($s['salle_code']??'—') ?></td>
            <td><?= substr($s['date'],0,10) ?></td>
            <td><span class="badge" style="background:<?= $col[$s['etat']]??'#374151' ?>"><?= $s['etat'] ?></span></td>
            <td><?= $restantes ?>/<?= $s['capacite_max'] ?></td>
            <td>
                <a href="modifier.php?id=<?= $s['id_seance'] ?>" class="btn btn-edit me-1"><i class="bi bi-pencil"></i></a>
                <a href="supprimer.php?id=<?= $s['id_seance'] ?>" class="btn btn-del"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; endif; ?>
    </tbody>
</table>
</div>
<?php include '../../src/includes/footer.php'; ?>
