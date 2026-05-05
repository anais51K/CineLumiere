<?php
require_once '../../src/repository/CodePromoRepository.php';
$promos = (new CodePromoRepository())->getAll();
$msg = $_GET['msg'] ?? '';
?>
<?php include '../../src/includes/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title mb-0">Codes Promo <span class="badge bg-secondary ms-2"><?= count($promos) ?></span></h2>
    <a href="ajouter.php" class="btn btn-cl btn-sm"><i class="bi bi-plus-lg me-1"></i>Créer</a>
</div>
<?php if($msg==='ok'): ?><div class="msg-ok">Opération réussie.</div><?php endif; ?>
<?php if($msg==='doublon'): ?><div class="msg-err">Ce code existe déjà.</div><?php endif; ?>
<div class="card-dark p-0">
<table class="table table-cl table-hover mb-0">
    <thead><tr><th class="ps-3">Code</th><th>Réduction</th><th>État</th><th>Actions</th></tr></thead>
    <tbody>
    <?php if(empty($promos)): ?>
        <tr><td colspan="4" class="text-center text-secondary py-4">Aucun code promo.</td></tr>
    <?php else: foreach($promos as $p): ?>
        <tr>
            <td class="ps-3"><strong><?= htmlspecialchars($p['code']) ?></strong></td>
            <td><?= $p['pourcentage'] ?>%</td>
            <td><span class="badge" style="background:<?= $p['etat']==='actif'?'#065f46':'#374151' ?>"><?= $p['etat'] ?></span></td>
            <td>
                <a href="modifier.php?id=<?= $p['id_code_promo'] ?>" class="btn btn-edit me-1"><i class="bi bi-pencil"></i></a>
                <a href="supprimer.php?id=<?= $p['id_code_promo'] ?>" class="btn btn-del"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; endif; ?>
    </tbody>
</table>
</div>
<?php include '../../src/includes/footer.php'; ?>
