<?php
require_once __DIR__ . '/../bdd/Bdd.php';

class CodePromoRepository
{
    private $connexionBdd;

    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getCodePromo($idCodePromo)
    {
        $sql = "SELECT * FROM code_promo WHERE id_code_promo = :id_code_promo";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_code_promo', $idCodePromo, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCodePromo()
    {
        $sql = "SELECT * FROM code_promo ORDER BY code ASC";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCode($code)
    {
        $req = $this->connexionBdd->prepare("SELECT * FROM code_promo WHERE code=:code AND etat='actif'");
        $req->execute([':code' => strtoupper(trim($code))]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function ajouterCodePromo($data)
    {
        $sql = "INSERT INTO code_promo (code, pourcentage, etat) VALUES (:code, :pourcentage, :etat)";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':code',       strtoupper(trim($data['code'])));
        $req->bindValue(':pourcentage',$data['pourcentage']);
        $req->bindValue(':etat',       $data['etat'] ?? 'actif');
        $req->execute();
        return $this->connexionBdd->lastInsertId();
    }

    public function modifierCodePromo($id, $data)
    {
        $sql = "UPDATE code_promo SET code=:code, pourcentage=:pourcentage, etat=:etat WHERE id_code_promo=:id";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':code',       strtoupper(trim($data['code'])));
        $req->bindValue(':pourcentage',$data['pourcentage']);
        $req->bindValue(':etat',       $data['etat']);
        $req->bindValue(':id',         $id, PDO::PARAM_INT);
        return $req->execute();
    }

    public function supprimerCodePromo($idCodePromo)
    {
        $sql = "DELETE FROM code_promo WHERE id_code_promo = :id_code_promo";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_code_promo', $idCodePromo, PDO::PARAM_INT);
        return $req->execute();
    }

    // Alias
    public function getAll()    { return $this->getAllCodePromo(); }
    public function getById($id){ return $this->getCodePromo($id); }
    public function ajouter($d) { return $this->ajouterCodePromo($d); }
    public function modifier($id,$d){ return $this->modifierCodePromo($id,$d); }
    public function supprimer($id)  { return $this->supprimerCodePromo($id); }
}
