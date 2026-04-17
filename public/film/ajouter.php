<?php
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrateur – Ciné Lumière</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
    </style>
</head>
<body>

<nav class="navbar navbar-dark px-4 mb-4">
    <span class="navbar-brand mb-0 h1">Ciné Lumière – Dashboard Admin</span>
</nav>

<div class="container-fluid">
    <h2>AJouter un film</h2>
    <form method="post" action="../../src/traitement/film/ajouterFilmTraitement.php">
        <input>
        <input>
        <input>
        <input type="submit">
    </form>
</div>