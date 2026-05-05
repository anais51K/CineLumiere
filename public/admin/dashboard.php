<?php

// Chargement des repositories
use repository\FilmRepository;

require_once __DIR__ . '/../../src/repository/FilmRepository.php';
require_once __DIR__ . '/../../src/repository/SalleRepository.php';
require_once __DIR__ . '/../../src/repository/SeanceRepository.php';
require_once __DIR__ . '/../../src/repository/ReservationRepository.php';
require_once __DIR__ . '/../../src/repository/CodePromoRepository.php';


// Récupération des données
$filmRepo        = new FilmRepository();
$salleRepo       = new SalleRepository();
$seanceRepo      = new SeanceRepository();
$reservationRepo = new ReservationRepository();
$promoRepo       = new CodePromoRepository();

$films        = $filmRepo->getAll();
$salles       = $salleRepo->getAll();
$seances      = $seanceRepo->getAll();
$reservations = $reservationRepo->getAll();
$promos       = $promoRepo->getAll();

$now = new DateTime();

// Indicateurs
$sallesActives = count(array_filter($salles, fn($s) => $s['etat'] === 'disponible'));
$seancesAvenir = count(array_filter($seances, fn($s) => new DateTime($s['date']) > $now && $s['etat'] === 'programmée'));
$resaAttente   = count(array_filter($reservations, fn($r) => $r['etat'] === 'en attente'));

// Alertes
$alertes = [];
$filmsAvecSeance = array_unique(array_column($seances, 'ref_film'));

foreach ($films as $f) {
    if (!in_array($f->getIdFilm(), $filmsAvecSeance)) {
        $alertes[] = "Le film \"" . htmlspecialchars($f->getNom()) . "\" n'a aucune séance programmée.";
        break;
    }
}

foreach ($promos as $p) {
    if ($p['etat'] === 'expiré') {
        $alertes[] = "Des codes promotionnels sont expirés.";
        break;
    }
}

foreach ($seances as $s) {
    if ($s['etat'] === 'annulée') {
        $alertes[] = "Des séances ont été annulées.";
        break;
    }
}

// Prochaines séances
$prochaines = array_filter($seances, fn($s) => new DateTime($s['date']) > $now && $s['etat'] === 'programmée');
usort($prochaines, fn($a, $b) => strcmp($a['date'], $b['date']));
$prochaines = array_slice($prochaines, 0, 6);

// Dernières réservations
$dernieres = array_slice(array_reverse($reservations), 0, 5);

$colSeance = [
        'programmée' => '#1d4ed8',
        'en cours'   => '#065f46',
        'terminée'   => '#374151',
        'annulée'    => '#7f1d1d'
];

$colResa = [
        'en attente'  => '#92400e',
        'confirmée'   => '#065f46',
        'annulée'     => '#7f1d1d',
        'remboursée'  => '#374151'
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ciné Lumières</title>

    <!-- CSS existants -->
    <link href="../../ressources/header.css" rel="stylesheet">
    <link href="../../ressources/footer.css" rel="stylesheet">
    <link href="../../ressources/dashboard.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body { background:#0f172a; color:#e5e7eb; }
        .navbar { background:#020617; }
        .kpi-card { background:#111827; border-radius:10px; padding:18px; }
        .kpi-label { font-size:0.85rem; text-transform:uppercase; color:#9ca3af; }
        .kpi-value { font-size:1.6rem; font-weight:700; }
        .section-title { margin-top:30px; margin-bottom:15px; font-weight:600; }
        .card-dark { background:#020617; border-radius:10px; border:1px solid #1f2937; }
        .badge-status { font-size:0.75rem; }
        .table-dark-custom { --bs-table-bg:#020617; --bs-table-border-color:#1f2937; }
        .btn-action { background:#1d4ed8; border:none; }
        .btn-action:hover { background:#2563eb; }
        .alert-item { border-left:4px solid #f97316; padding-left:10px; margin-bottom:6px; }
    </style> -->
</head>

<body>

<!-- ================= HEADER ================= -->
<nav class="navbar navbar-expand-lg py-3">
    <div class="container-fluid">

        <a class="navbar-brand fs-3 fw-bold" href="../accueil.php">Cinéma Lumières</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuBurger">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuBurger">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="../accueil.php">🎬 Films</a></li>
                <li class="nav-item"><a class="nav-link" href="../offre.html">💳 Offres</a></li>
                <li class="nav-item"><a class="nav-link" href="../connexion.html">🔑 Connexion</a></li>
            </ul>
        </div>

    </div>
</nav>

<h2 class="page-title">Indicateurs clés</h2>
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <a href="/Cine_Lumiere/public/film/liste.php" style="text-decoration:none">
            <div class="card-dark text-center py-3"><div style="color:#9ca3af;font-size:.8rem;text-transform:uppercase">Films</div><div style="font-size:2rem;font-weight:700"><?= count($films) ?></div></div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="../salle/liste.php" style="text-decoration:none">
            <div class="card-dark text-center py-3"><div style="color:#9ca3af;font-size:.8rem;text-transform:uppercase">Salles actives</div><div style="font-size:2rem;font-weight:700"><?= $sallesActives ?></div></div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="../seance/liste.php" style="text-decoration:none">
            <div class="card-dark text-center py-3"><div style="color:#9ca3af;font-size:.8rem;text-transform:uppercase">Séances à venir</div><div style="font-size:2rem;font-weight:700"><?= $seancesAvenir ?></div></div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="../reservation/liste.php" style="text-decoration:none">
            <div class="card-dark text-center py-3"><div style="color:#9ca3af;font-size:.8rem;text-transform:uppercase">Résa en attente</div><div style="font-size:2rem;font-weight:700"><?= $resaAttente ?></div></div>
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <h2 class="page-title">Prochaines séances</h2>
        <div class="card-dark p-0 mb-4">
            <table class="table table-cl table-hover mb-0">
                <thead><tr><th class="ps-3">Film</th><th>Salle</th><th>Date</th><th>Places restantes</th><th>État</th></tr></thead>
                <tbody>
                <?php if(empty($prochaines)): ?>
                    <tr><td colspan="5" class="text-center text-secondary py-3">Aucune séance à venir.</td></tr>
                <?php else: foreach($prochaines as $s):
                    $restantes = $seanceRepo->getPlacesRestantes($s['id_seance'], $s['capacite_max']);
                    ?>
                    <tr>
                        <td class="ps-3"><?= htmlspecialchars($s['film_nom']??'—') ?></td>
                        <td><?= htmlspecialchars($s['salle_code']??'—') ?></td>
                        <td><?= substr($s['date'],0,10) ?></td>
                        <td><?= $restantes ?>/<?= $s['capacite_max'] ?></td>
                        <td><span class="badge" style="background:<?= $colSeance[$s['etat']]??'#374151' ?>"><?= $s['etat'] ?></span></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>

        <h2 class="page-title">Dernières réservations</h2>
        <div class="card-dark p-0">
            <table class="table table-cl table-hover mb-0">
                <thead><tr><th class="ps-3">#</th><th>Film</th><th>Places</th><th>Total</th><th>État</th></tr></thead>
                <tbody>
                <?php if(empty($dernieres)): ?>
                    <tr><td colspan="5" class="text-center text-secondary py-3">Aucune réservation.</td></tr>
                <?php else: foreach($dernieres as $r):
                    $total = ($r['nbre_places_adulte']*15)+($r['nbre_places_senior']*5)+($r['nbre_places_etudiant']*10);
                    ?>
                    <tr>
                        <td class="ps-3">#<?= $r['id_reservation'] ?></td>
                        <td><?= htmlspecialchars($r['film_nom']??'—') ?></td>
                        <td><?= $r['nbre_places_adulte']+$r['nbre_places_senior']+$r['nbre_places_etudiant'] ?></td>
                        <td><?= number_format($total,2) ?> €</td>
                        <td><span class="badge" style="background:<?= $colResa[$r['etat']]??'#374151' ?>"><?= $r['etat'] ?></span></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-lg-4">
        <h2 class="page-title">Alertes</h2>
        <div class="card-dark mb-4">
            <?php if(empty($alertes)): ?>
                <div class="text-center py-2"><i class="bi bi-check-circle text-success" style="font-size:2rem"></i><p class="mt-2 text-secondary mb-0">Aucune alerte</p></div>
            <?php else: foreach($alertes as $a): ?>
                <div style="border-left:4px solid #f97316;padding-left:10px;margin-bottom:8px;color:#fdba74;font-size:.88rem"><?= $a ?></div>
            <?php endforeach; endif; ?>
        </div>

        <h2 class="page-title">Actions rapides</h2>
        <div class="card-dark"><div class="d-grid gap-2">
                <a href="../film/ajouter.php" class="btn btn-cl btn-sm"><i class="bi bi-plus-lg me-1"></i>Ajouter un film</a>
                <a href="../salle/ajouter.php" class="btn btn-cl btn-sm"><i class="bi bi-plus-lg me-1"></i>Ajouter une salle</a>
                <a href="../seance/ajouter.php" class="btn btn-cl btn-sm"><i class="bi bi-plus-lg me-1"></i>Programmer une séance</a>
                <a href="../reservation/ajouter.php" class="btn btn-cl btn-sm"><i class="bi bi-plus-lg me-1"></i>Ajouter une réservation</a>
                <a href="../codepromo/ajouter.php" class="btn btn-cl btn-sm"><i class="bi bi-plus-lg me-1"></i>Créer un code promo</a>
            </div></div>
    </div>
</div>
<footer class="text-white py-4 mt-5">
    <div class="container text-center">
        <p class="mb-2 fs-5">
            © 2025 – Tous droits réservés Anaïs Kriegel--Grapain - Abdel-Hamid El-Ferkh -
            Younes Leulmi - Walid Souali
        </p>
    </div>
</footer>

</body>
</html>

