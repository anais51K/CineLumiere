<?php
require_once '../../src/repository/ReservationRepository.php';
require_once '../../src/repository/SeanceRepository.php';
require_once '../../src/repository/CodePromoRepository.php';
$id   = (int)($_GET['id'] ?? 0);
$r    = (new ReservationRepository())->getById($id);
if (!$r) { header('Location: liste.php'); exit; }
if ($r['etat']==='confirmée') { header('Location: liste.php?msg=err'); exit; }
$seances = (new SeanceRepository())->getAll();
$promos  = array_filter((new CodePromoRepository())->getAll(), fn($p) => $p['etat']==='actif');
$err = $_GET['err'] ?? '';
?>
<?php include '../../src/includes/header.php'; ?>
<h2 class="page-title">Modifier la réservation #<?= $id ?></h2>
<?php if($err): ?><div class="msg-err"><?= htmlspecialchars($err) ?></div><?php endif; ?>
<div class="card-dark" style="max-width:580px">
<form method="POST" action="../../src/traitement/reservation/modifierReservationTraitement.php">
    <input type="hidden" name="id" value="<?= $r['id_reservation'] ?>">
    <div class="row g-3">
        <div class="col-12"><label class="form-label">Séance *</label>
            <select class="form-select" name="ref_seance" required>
                <?php foreach($seances as $s): ?><option value="<?= $s['id_seance'] ?>" <?= $s['id_seance']==$r['ref_seance']?'selected':'' ?>><?= htmlspecialchars($s['film_nom']??'?') ?> – <?= substr($s['date'],0,10) ?></option><?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4"><label class="form-label">Places adulte (15€)</label><input class="form-control" type="number" name="nbre_places_adulte" min="0" value="<?= $r['nbre_places_adulte'] ?>"></div>
        <div class="col-md-4"><label class="form-label">Places senior (5€)</label><input class="form-control" type="number" name="nbre_places_senior" min="0" value="<?= $r['nbre_places_senior'] ?>"></div>
        <div class="col-md-4"><label class="form-label">Places étudiant (10€)</label><input class="form-control" type="number" name="nbre_places_etudiant" min="0" value="<?= $r['nbre_places_etudiant'] ?>"></div>
        <div class="col-md-6"><label class="form-label">Mode paiement</label>
            <select class="form-select" name="mode_paiement">
                <?php foreach(['en ligne','carte','espèces','chèque'] as $m): ?><option value="<?= $m ?>" <?= $r['mode_paiement']===$m?'selected':'' ?>><?= ucfirst($m) ?></option><?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6"><label class="form-label">État</label>
            <select class="form-select" name="etat">
                <?php foreach(['en attente','confirmée','annulée','remboursée'] as $e): ?><option value="<?= $e ?>" <?= $r['etat']===$e?'selected':'' ?>><?= ucfirst($e) ?></option><?php endforeach; ?>
            </select>
        </div>
        <div class="col-12"><label class="form-label">Code promo</label>
            <select class="form-select" name="ref_code_promo">
                <option value="">— Aucun —</option>
                <?php foreach($promos as $p): ?><option value="<?= $p['id_code_promo'] ?>" <?= $p['id_code_promo']==$r['ref_code_promo']?'selected':'' ?>><?= htmlspecialchars($p['code']) ?> (−<?= $p['pourcentage'] ?>%)</option><?php endforeach; ?>
            </select>
        </div>
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-cl">Enregistrer</button>
            <a href="liste.php" class="btn btn-secondary">Annuler</a>
        </div>
    </div>
</form>
</div>
<?php include '../../src/includes/footer.php'; ?>
