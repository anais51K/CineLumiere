<?php
require_once '../../src/repository/SalleRepository.php';
$id = (int)($_GET['id'] ?? 0);
$s  = (new SalleRepository())->getById($id);
if (!$s) { header('Location: liste.php'); exit; }
$err = $_GET['err'] ?? '';
?>
<?php include '../../src/includes/header.php'; ?>
<h2 class="page-title">Modifier la salle</h2>
<?php if($err): ?><div class="msg-err"><?= htmlspecialchars($err) ?></div><?php endif; ?>
<div class="card-dark" style="max-width:500px">
<form method="POST" action="/Cine_Lumiere/src/traitement/salle/modifierSalleTraitement.php">
    <input type="hidden" name="id" value="<?= $s['id_salle'] ?>">
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Code *</label><input class="form-control" name="code" value="<?= htmlspecialchars($s['code']) ?>" required></div>
        <div class="col-md-6"><label class="form-label">Capacité max *</label><input class="form-control" type="number" name="capacite_max" min="1" value="<?= $s['capacite_max'] ?>" required></div>
        <div class="col-12"><label class="form-label">État</label>
            <select class="form-select" name="etat">
                <?php foreach(['disponible','maintenance','fermée'] as $e): ?>
                <option value="<?= $e ?>" <?= $s['etat']===$e?'selected':'' ?>><?= ucfirst($e) ?></option>
                <?php endforeach; ?>
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
