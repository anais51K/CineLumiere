<?php
namespace repository;

require_once __DIR__ . '/../bdd/Bdd.php';
require_once __DIR__ . '/../modele/Film.php';

use Bdd;
use PDO;
use Film;

class FilmRepository
{
    private $connexionBdd;

    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    /* ============================
       Récupérer un film par ID
       ============================ */
    public function getFilm($idFilm)
    {
        $sql = "SELECT * FROM film WHERE id_film = :id_film";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_film', $idFilm, PDO::PARAM_INT);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        return new Film(
            $row['id_film'],
            $row['nom'],
            $row['duree'],
            $row['affiche'],
            $row['genre'],
            $row['age_min'],
            $row['realisateur'],
            $row['date_sortie'],
            $row['bande_annonce'],
            $row['resume'] ?? null   // ← 10e paramètre ajouté
        );
    }

    /* ============================
       Récupérer tous les films
       ============================ */
    public function getAllFilm()
    {
        $sql = "SELECT * FROM film ORDER BY nom ASC";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();

        $rows = $req->fetchAll(PDO::FETCH_ASSOC);
        $films = [];

        foreach ($rows as $row) {
            $films[] = new Film(
                $row['id_film'],
                $row['nom'],
                $row['duree'],
                $row['affiche'],
                $row['genre'],
                $row['age_min'],
                $row['realisateur'],
                $row['date_sortie'],
                $row['bande_annonce'],
                $row['resume'] ?? null   // ← 10e paramètre ajouté
            );
        }

        return $films;
    }

    /* ============================
       Ajouter un film
       ============================ */
    public function ajouterFilm($data)
    {
        $sql = "INSERT INTO film 
                (nom, duree, affiche, genre, age_min, realisateur, date_sortie, bande_annonce, resume)
                VALUES 
                (:nom, :duree, :affiche, :genre, :age_min, :realisateur, :date_sortie, :bande_annonce, :resume)";

        $req = $this->connexionBdd->prepare($sql);

        $req->bindValue(':nom',           $data['nom']);
        $req->bindValue(':duree',         $data['duree'], PDO::PARAM_INT);
        $req->bindValue(':affiche',       $data['affiche']       ?? null);
        $req->bindValue(':genre',         $data['genre']         ?? null);
        $req->bindValue(':age_min',       $data['age_min']       ?? 0, PDO::PARAM_INT);
        $req->bindValue(':realisateur',   $data['realisateur']   ?? null);
        $req->bindValue(':date_sortie',   $data['date_sortie']   ?? null);
        $req->bindValue(':bande_annonce', $data['bande_annonce'] ?? null);
        $req->bindValue(':resume',        $data['resume']        ?? null);

        $req->execute();

        return $this->connexionBdd->lastInsertId();
    }

    /* ============================
       Modifier un film
       ============================ */
    public function modifierFilm($id, $data)
    {
        $sql = "UPDATE film SET 
                    nom = :nom,
                    duree = :duree,
                    affiche = :affiche,
                    genre = :genre,
                    age_min = :age_min,
                    realisateur = :realisateur,
                    date_sortie = :date_sortie,
                    bande_annonce = :bande_annonce,
                    resume = :resume
                WHERE id_film = :id_film";

        $req = $this->connexionBdd->prepare($sql);

        $req->bindValue(':nom',           $data['nom']);
        $req->bindValue(':duree',         $data['duree'], PDO::PARAM_INT);
        $req->bindValue(':affiche',       $data['affiche']       ?? null);
        $req->bindValue(':genre',         $data['genre']         ?? null);
        $req->bindValue(':age_min',       $data['age_min']       ?? 0, PDO::PARAM_INT);
        $req->bindValue(':realisateur',   $data['realisateur']   ?? null);
        $req->bindValue(':date_sortie',   $data['date_sortie']   ?? null);
        $req->bindValue(':bande_annonce', $data['bande_annonce'] ?? null);
        $req->bindValue(':resume',        $data['resume']        ?? null);
        $req->bindValue(':id_film',       $id, PDO::PARAM_INT);

        return $req->execute();
    }

    /* ============================
       Supprimer un film
       ============================ */
    public function supprimerFilm($idFilm)
    {
        $sql = "DELETE FROM film WHERE id_film = :id_film";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_film', $idFilm, PDO::PARAM_INT);

        return $req->execute();
    }

    /* ============================
       Alias compatibles dashboard
       ============================ */
    public function getAll()      { return $this->getAllFilm(); }
    public function getById($id)  { return $this->getFilm($id); }
    public function ajouter($d)   { return $this->ajouterFilm($d); }
    public function modifier($id,$d){ return $this->modifierFilm($id,$d); }
    public function supprimer($id){ return $this->supprimerFilm($id); }
}
