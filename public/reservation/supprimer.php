<?php
require_once '../../src/repository/ReservationRepository.php';
$id = (int)($_GET['id'] ?? 0);
$r  = (new ReservationRepository())->getById($id);
if (!$r) { header('Location: liste.php'); exit; }
?>
<?php include '../../src/includes/header.php'; ?>
<h2 class="page-title">Supprimer la réservation</h2>
<div class="card-dark" style="max-width:500px">
    <p>Supprimer la réservation <strong>#<?= $r['id_reservation'] ?></strong> (<?= htmlspecialchars($r['film_nom']??'') ?>) ?</p>
    <form method="POST" action="../../src/traitement/reservation/supprimerReservationTraitement.php" class="d-flex gap-2">
        <input type="hidden" name="id" value="<?= $r['id_reservation'] ?>">
        <button type="submit" class="btn btn-del">Oui, supprimer</button>
        <a href="liste.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<?php include '../../src/includes/footer.php'; ?>
