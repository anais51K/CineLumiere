<?php
require_once '../../src/repository/ReservationRepository.php';
$reservations = (new ReservationRepository())->getAll();
$msg = $_GET['msg'] ?? '';
$col = ['en attente'=>'#92400e','confirmée'=>'#065f46','annulée'=>'#7f1d1d','remboursée'=>'#374151'];
?>
<?php include '../../src/includes/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title mb-0">Réservations <span class="badge bg-secondary ms-2"><?= count($reservations) ?></span></h2>
    <a href="ajouter.php" class="btn btn-cl btn-sm"><i class="bi bi-plus-lg me-1"></i>Ajouter</a>
</div>
<?php if($msg==='ok'): ?><div class="msg-ok">Opération réussie.</div><?php endif; ?>
<?php if($msg==='err'): ?><div class="msg-err">Réservation encaissée : modification impossible (CDC §5.7).</div><?php endif; ?>
<div class="card-dark p-0">
<table class="table table-cl table-hover mb-0">
    <thead><tr><th class="ps-3">#</th><th>Film</th><th>Séance</th><th>Adulte</th><th>Senior</th><th>Étudiant</th><th>Total</th><th>Paiement</th><th>État</th><th>Actions</th></tr></thead>
    <tbody>
    <?php if(empty($reservations)): ?>
        <tr><td colspan="10" class="text-center text-secondary py-4">Aucune réservation.</td></tr>
    <?php else: foreach($reservations as $r):
        $total = ($r['nbre_places_adulte']*15)+($r['nbre_places_senior']*5)+($r['nbre_places_etudiant']*10);
    ?>
        <tr>
            <td class="ps-3">#<?= $r['id_reservation'] ?></td>
            <td><?= htmlspecialchars($r['film_nom']??'—') ?></td>
            <td><?= substr($r['seance_date']??'—',0,10) ?></td>
            <td><?= $r['nbre_places_adulte'] ?></td>
            <td><?= $r['nbre_places_senior'] ?></td>
            <td><?= $r['nbre_places_etudiant'] ?></td>
            <td><?= number_format($total,2) ?> €</td>
            <td><?= $r['mode_paiement'] ?></td>
            <td><span class="badge" style="background:<?= $col[$r['etat']]??'#374151' ?>"><?= $r['etat'] ?></span></td>
            <td>
                <?php if($r['etat'] !== 'confirmée'): ?>
                <a href="modifier.php?id=<?= $r['id_reservation'] ?>" class="btn btn-edit me-1"><i class="bi bi-pencil"></i></a>
                <a href="supprimer.php?id=<?= $r['id_reservation'] ?>" class="btn btn-del"><i class="bi bi-trash"></i></a>
                <?php else: ?>
                <span class="text-secondary" style="font-size:.8rem">Encaissée</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; endif; ?>
    </tbody>
</table>
</div>
<?php include '../../src/includes/footer.php'; ?>
