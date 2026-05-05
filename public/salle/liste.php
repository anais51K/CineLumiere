<?php

use repository\SalleRepository;

require_once '../../src/repository/SalleRepository.php';
$salles = (new SalleRepository())->getAll();
$msg = $_GET['msg'] ?? '';
$col = ['disponible'=>'#065f46','maintenance'=>'#92400e','fermée'=>'#374151'];
?>
<?php include '../../src/includes/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title mb-0">Salles <span class="badge bg-secondary ms-2"><?= count($salles) ?></span></h2>
    <a href="ajouter.php" class="btn btn-cl btn-sm"><i class="bi bi-plus-lg me-1"></i>Ajouter</a>
</div>
<?php if($msg==='ok'): ?><div class="msg-ok">Opération réussie.</div><?php endif; ?>
<?php if($msg==='err'): ?><div class="msg-err">Erreur.</div><?php endif; ?>
<div class="card-dark p-0">
<table class="table table-cl table-hover mb-0">
    <thead><tr><th class="ps-3">Code</th><th>Capacité</th><th>État</th><th>Actions</th></tr></thead>
    <tbody>
    <?php if(empty($salles)): ?>
        <tr><td colspan="4" class="text-center text-secondary py-4">Aucune salle.</td></tr>
    <?php else: foreach($salles as $s): ?>
        <tr>
            <td class="ps-3"><strong><?= htmlspecialchars($s['code']) ?></strong></td>
            <td><?= $s['capacite_max'] ?> places</td>
            <td><span class="badge" style="background:<?= $col[$s['etat']]??'#374151' ?>"><?= $s['etat'] ?></span></td>
            <td>
                <a href="modifier.php?id=<?= $s['id_salle'] ?>" class="btn btn-edit me-1"><i class="bi bi-pencil"></i></a>
                <a href="supprimer.php?id=<?= $s['id_salle'] ?>" class="btn btn-del"><i class="bi bi-slash-circle"></i></a>
            </td>
        </tr>
    <?php endforeach; endif; ?>
    </tbody>
</table>
</div>
<p class="text-secondary mt-2" style="font-size:.8rem"><i class="bi bi-info-circle me-1"></i>CDC §5.2 : pas de suppression physique, la salle sera désactivée.</p>
<?php include '../../src/includes/footer.php'; ?>
