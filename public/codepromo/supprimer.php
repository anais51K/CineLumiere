<?php
require_once '../../src/repository/CodePromoRepository.php';
$id = (int)($_GET['id'] ?? 0);
$p  = (new CodePromoRepository())->getById($id);
if (!$p) { header('Location: liste.php'); exit; }
?>
<?php include '../../src/includes/header.php'; ?>
<h2 class="page-title">Supprimer le code promo</h2>
<div class="card-dark" style="max-width:500px">
    <p>Supprimer le code <strong><?= htmlspecialchars($p['code']) ?></strong> ?</p>
    <form method="POST" action="/Cine_Lumiere/src/traitement/codepromo/supprimerCodePromoTraitement.php" class="d-flex gap-2">
        <input type="hidden" name="id" value="<?= $p['id_code_promo'] ?>">
        <button type="submit" class="btn btn-del">Oui, supprimer</button>
        <a href="liste.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<?php include '../../src/includes/footer.php'; ?>
