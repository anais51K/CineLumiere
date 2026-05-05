<?php $err = $_GET['err'] ?? ''; ?>
<?php include '../../src/includes/header.php'; ?>
<h2 class="page-title">Créer un code promo</h2>
<?php if($err): ?><div class="msg-err"><?= htmlspecialchars($err) ?></div><?php endif; ?>
<div class="card-dark" style="max-width:450px">
<form method="POST" action="/Cine_Lumiere/src/traitement/codepromo/ajouterCodePromoTraitement.php">
    <div class="row g-3">
        <div class="col-md-5"><label class="form-label">Code *</label><input class="form-control" name="code" placeholder="ETE2026" style="text-transform:uppercase" required></div>
        <div class="col-md-4"><label class="form-label">Réduction (%) *</label><input class="form-control" type="number" name="pourcentage" min="0" max="100" step="0.01" required></div>
        <div class="col-md-3"><label class="form-label">État</label>
            <select class="form-select" name="etat">
                <option value="actif">Actif</option>
                <option value="expiré">Expiré</option>
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
