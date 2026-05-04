<?php
require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Film.php";
require_once "../../src/modele/Seance.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/repository/SeanceRepository.php";

$filmRepository = new FilmRepository();
$film= $filmRepository->getFilm($_GET["id"]);
$seanceRepository = new SeanceRepository();
$seance = $seanceRepository->getSeance($_GET["id"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$film->getNom()?></title>
    <link href="../../ressources/header.css" rel="stylesheet">
    <link href="../../ressources/film/detail_film.css" rel="stylesheet">
    <link href="../../ressources/footer.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg py-3">
    <div class="container-fluid">

        <a class="navbar-brand fs-3 fw-bold" href="../accueil.php">Cinéma Lumières</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuBurger">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuBurger">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#films">🎬 Films</a></li>
                <li class="nav-item"><a class="nav-link" href="#films">🎞️ Séances</a></li>
                <li class="nav-item"><a class="nav-link" href="offre.html">💳 Offres</a></li>
                <li class="nav-item"><a class="nav-link" href="connexion.html">🔑 Connexion</a></li>

            </ul>
        </div>

    </div>
</nav>

<div class="film-card">
    <h2 class="film-title"><?=$film->getNom()?></h2>
    <img class="film-poster" src="<?= $film->getAffiche() ?>"alt=<?=$film->getNom()?> />
    <div class="film-resume">
        <br>
        <p><?=$film->getGenre()?></p>
        <p><strong>Durée:</strong> <?= $film->getDuree() ?></p>
        <p><strong>Date de sortie:</strong> <?= $film->getDateSortie() ?></p>
        <p><strong>De</strong> <?= $film->getRealisateur() ?> | <strong>Par</strong> Eric Roth</p>
        <p><strong>Avec</strong>  Tom Hanks, Gary Sinise, Robin Wright</p>
        <br>
        <h3>Résumé</h3>
        <p>
            <?= $film->getResume() ?>
        </p>
    </div>
</div>
<br>
<form action="tarif.html" method="POST">
    <input type="hidden" name="ref_seance" value="<?= $seance ['seance'] ?>">

    <div class="seances-container">
        <input type="checkbox" id="toggleSeances">
        <label for="toggleSeances" class="seances-btn">📅 Choisir une séance</label>

        <div class="seances-panel">

            <!-- Calendrier jours -->
            <h3>Choisissez un jour</h3>
            <div class="calendrier">

                <input type="radio" name="jour" id="j1" value="2025-05-05">
                <label for="j1" class="jour-btn">
                    <span class="jour-nom">Lun</span>
                    <span class="jour-date">5 mai</span>
                </label>

                <input type="radio" name="jour" id="j2" value="2025-05-06">
                <label for="j2" class="jour-btn">
                    <span class="jour-nom">Mar</span>
                    <span class="jour-date">6 mai</span>
                </label>

                <input type="radio" name="jour" id="j3" value="2025-05-07">
                <label for="j3" class="jour-btn">
                    <span class="jour-nom">Mer</span>
                    <span class="jour-date">7 mai</span>
                </label>

                <input type="radio" name="jour" id="j4" value="2025-05-08">
                <label for="j4" class="jour-btn">
                    <span class="jour-nom">Jeu</span>
                    <span class="jour-date">8 mai</span>
                </label>

                <input type="radio" name="jour" id="j5" value="2025-05-09">
                <label for="j5" class="jour-btn">
                    <span class="jour-nom">Ven</span>
                    <span class="jour-date">9 mai</span>
                </label>

                <input type="radio" name="jour" id="j6" value="2025-05-10">
                <label for="j6" class="jour-btn">
                    <span class="jour-nom">Sam</span>
                    <span class="jour-date">10 mai</span>
                </label>

                <input type="radio" name="jour" id="j7" value="2025-05-11">
                <label for="j7" class="jour-btn">
                    <span class="jour-nom">Dim</span>
                    <span class="jour-date">11 mai</span>
                </label>

            </div>

            <!-- Horaires -->
            <h3 style="margin-top: 1.5rem;">Choisissez un horaire</h3>
            <div class="horaires">

                <input type="radio" name="horaire" id="h1" value="14:00">
                <label for="h1" class="horaire-btn">14h00</label>

                <input type="radio" name="horaire" id="h2" value="17:30">
                <label for="h2" class="horaire-btn">17h30</label>

                <input type="radio" name="horaire" id="h3" value="20:00">
                <label for="h3" class="horaire-btn">20h00</label>

            </div>

            <!-- Bouton confirmation -->
            <button class="reserver-btn" style="margin-top: 1.5rem;">✅ Confirmer la réservation</button>

        </div>
    </div>
</form>
<h1>Bande annonce</h1>
<iframe width="560" height="315"
        src="https://www.youtube.com/embed/XHhAG-YLdk8"
        title="Bande-annonce"
        frameborder="0"
        allowfullscreen>
</iframe>
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

