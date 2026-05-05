<?php $err = $_GET['err'] ?? ''; ?>
<?php include '../../src/includes/header.php'; ?>
<h2 class="page-title">Ajouter une salle</h2>
<?php if($err): ?><div class="msg-err"><?= htmlspecialchars($err) ?></div><?php endif; ?>
<div class="card-dark" style="max-width:500px">
<form method="POST" action="../../src/traitement/salle/ajouterSalleTraitement.php">
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Code *</label><input class="form-control" name="code" placeholder="SALLE-A" required></div>
        <div class="col-md-6"><label class="form-label">Capacité max *</label><input class="form-control" type="number" name="capacite_max" min="1" required></div>
        <div class="col-12"><label class="form-label">État</label>
            <select class="form-select" name="etat">
                <option value="disponible">Disponible</option>
                <option value="maintenance">Maintenance</option>
                <option value="fermée">Fermée</option>
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
