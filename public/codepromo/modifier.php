<?php
require_once '../../src/repository/CodePromoRepository.php';
$id = (int)($_GET['id'] ?? 0);
$p  = (new CodePromoRepository())->getById($id);
if (!$p) { header('Location: liste.php'); exit; }
$err = $_GET['err'] ?? '';
?>
<?php include '../../src/includes/header.php'; ?>
<h2 class="page-title">Modifier le code promo</h2>
<?php if($err): ?><div class="msg-err"><?= htmlspecialchars($err) ?></div><?php endif; ?>
<div class="card-dark" style="max-width:450px">
<form method="POST" action="../../src/traitement/codepromo/modifierCodePromoTraitement.php">
    <input type="hidden" name="id" value="<?= $p['id_code_promo'] ?>">
    <div class="row g-3">
        <div class="col-md-5"><label class="form-label">Code *</label><input class="form-control" name="code" value="<?= htmlspecialchars($p['code']) ?>" style="text-transform:uppercase" required></div>
        <div class="col-md-4"><label class="form-label">Réduction (%) *</label><input class="form-control" type="number" name="pourcentage" min="0" max="100" step="0.01" value="<?= $p['pourcentage'] ?>" required></div>
        <div class="col-md-3"><label class="form-label">État</label>
            <select class="form-select" name="etat">
                <option value="actif" <?= $p['etat']==='actif'?'selected':'' ?>>Actif</option>
                <option value="expiré" <?= $p['etat']==='expiré'?'selected':'' ?>>Expiré</option>
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
