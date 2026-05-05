<?php

use repository\SalleRepository;

require_once '../../src/repository/FilmRepository.php';
require_once '../../src/repository/SalleRepository.php';
$films  = (new FilmRepository())->getAll();
$salles = (new SalleRepository())->getAll();
$err = $_GET['err'] ?? '';
?>
<?php include '../../src/includes/header.php'; ?>
<h2 class="page-title">Programmer une séance</h2>
<?php if($err): ?><div class="msg-err"><?= htmlspecialchars($err) ?></div><?php endif; ?>
<div class="card-dark" style="max-width:550px">
<form method="POST" action="/Cine_Lumiere/src/traitement/seance/ajouterSeanceTraitement.php">
    <div class="row g-3">
        <div class="col-12"><label class="form-label">Film *</label>
            <select class="form-select" name="ref_film" required>
                <?php foreach($films as $f): ?><option value="<?= $f['id_film'] ?>"><?= htmlspecialchars($f['nom']) ?></option><?php endforeach; ?>
            </select>
        </div>
        <div class="col-12"><label class="form-label">Salle *</label>
            <select class="form-select" name="ref_salle" required>
                <?php foreach($salles as $s): ?><option value="<?= $s['id_salle'] ?>"><?= htmlspecialchars($s['code']) ?> (<?= $s['capacite_max'] ?> places)</option><?php endforeach; ?>
            </select>
        </div>
        <div class="col-12">
            <label class="form-label">Date *</label>
            <input class="form-control" type="date" name="date" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
            <small class="text-secondary">Doit être au minimum demain (CDC §5.4)</small>
        </div>
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-cl">Enregistrer</button>
            <a href="liste.php" class="btn btn-secondary">Annuler</a>
        </div>
    </div>
</form>
</div>
<?php include '../../src/includes/footer.php'; ?>
