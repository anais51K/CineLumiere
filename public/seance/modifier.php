<?php
require_once '../../src/repository/SeanceRepository.php';
require_once '../../src/repository/FilmRepository.php';
require_once '../../src/repository/SalleRepository.php';
$id   = (int)($_GET['id'] ?? 0);
$repo = new SeanceRepository();
$s    = $repo->getById($id);
if (!$s) { header('Location: liste.php'); exit; }
// CDC §5.4 : modification interdite si réservations
if ($repo->aDesReservations($id)) { header('Location: liste.php?msg=reservee'); exit; }
$films  = (new FilmRepository())->getAll();
$salles = (new SalleRepository())->getAll();
$err = $_GET['err'] ?? '';
?>
<?php include '../../src/includes/header.php'; ?>
<h2 class="page-title">Modifier la séance</h2>
<?php if($err): ?><div class="msg-err"><?= htmlspecialchars($err) ?></div><?php endif; ?>
<div class="card-dark" style="max-width:550px">
<form method="POST" action="../../src/traitement/seance/modifierSeanceTraitement.php">
    <input type="hidden" name="id" value="<?= $s['id_seance'] ?>">
    <div class="row g-3">
        <div class="col-12"><label class="form-label">Film *</label>
            <select class="form-select" name="ref_film" required>
                <?php foreach($films as $f): ?><option value="<?= $f['id_film'] ?>" <?= $f['id_film']==$s['ref_film']?'selected':'' ?>><?= htmlspecialchars($f['nom']) ?></option><?php endforeach; ?>
            </select>
        </div>
        <div class="col-12"><label class="form-label">Salle *</label>
            <select class="form-select" name="ref_salle" required>
                <?php foreach($salles as $sl): ?><option value="<?= $sl['id_salle'] ?>" <?= $sl['id_salle']==$s['ref_salle']?'selected':'' ?>><?= htmlspecialchars($sl['code']) ?> (<?= $sl['capacite_max'] ?> places)</option><?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-8">
            <label class="form-label">Date *</label>
            <input class="form-control" type="date" name="date" value="<?= substr($s['date'],0,10) ?>" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
        </div>
        <div class="col-md-4"><label class="form-label">État</label>
            <select class="form-select" name="etat">
                <?php foreach(['programmée','en cours','terminée','annulée'] as $e): ?><option value="<?= $e ?>" <?= $s['etat']===$e?'selected':'' ?>><?= ucfirst($e) ?></option><?php endforeach; ?>
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
