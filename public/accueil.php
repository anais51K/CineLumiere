<?php
require_once "../src/bdd/Bdd.php";
require_once "../src/modele/Film.php";
require_once "../src/repository/FilmRepository.php";

$filmRepository = new FilmRepository();
$films= $filmRepository->getAllFilm();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ciné Lumières</title>

    <!-- CSS existants -->
    <link href="../ressources/header.css" rel="stylesheet">
    <link href="../ressources/footer.css" rel="stylesheet">
    <link href="../ressources/page_accueil.css" rel="stylesheet">
</head>

<body>

<!-- ================= HEADER ================= -->
<nav class="navbar navbar-expand-lg py-3">
    <div class="container-fluid">

        <a class="navbar-brand fs-3 fw-bold" href="accueil.html">Cinéma Lumières</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuBurger">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuBurger">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#films">🎬 Films</a></li>
                <li class="nav-item"><a class="nav-link" href="">🎞️ Séances</a></li>
                <li class="nav-item"><a class="nav-link" href="offre.html">💳 Offres</a></li>
                <li class="nav-item"><a class="nav-link" href="connexion.html">🔑 Connexion</a></li>

            </ul>
        </div>

    </div>
</nav>

<main class="page">

    <h1 class="titre-page">Films à l'affiche</h1>

    <section class="film-row">

<?php
/** @var Film $film */
foreach ($films as $film){ ?>
        <div class="film">
            <a href="film/film.php?id=<?=$film->getIdFilm()?>">
                <img src="<?= $film->getAffiche() ?>"
                     alt="<?= $film->getNom() ?>">
                <h3><?= $film->getNom() ?></h3>
            </a>
        </div>
<?php } ?>


    </section>

</main>

<!-- formulaire contact-->
<div class="contact-wrapper">
    <h1 class="text-center">Contactez-Nous</h1>

    <form action="../src/traitement/traitement_contact.php" method="POST" class="contact-form">

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>

        <button type="submit">Envoyer</button>
    </form>
</div>

<!-- ================= FOOTER ================= -->
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
